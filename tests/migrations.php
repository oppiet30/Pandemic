<?php
/** Tests only a randomly created database, using synthetic rows. */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = getenv('MYSQL_TEST_HOST');
if (!$host) throw new RuntimeException('Set MYSQL_TEST_HOST explicitly to a test server.');
$conn = mysqli_connect($host, getenv('MYSQL_TEST_USER') ?: 'root', getenv('MYSQL_TEST_PASSWORD') ?: '', '', (int) (getenv('MYSQL_TEST_PORT') ?: 3306));
$database = 'pandemic_migration_' . bin2hex(random_bytes(6));
mysqli_query($conn, "CREATE DATABASE `$database` CHARACTER SET utf8mb4");
mysqli_select_db($conn, $database);
mysqli_set_charset($conn, 'utf8mb4');
$names = array('admin'=>'admins', 'cartas'=>'cards', 'cartas_jogador'=>'player_cards', 'cidades'=>'cities', 'cidades_infectadas'=>'city_infections', 'doencas_erradicadas'=>'disease_cures', 'estado_jogo'=>'game_states', 'jogo'=>'games', 'user'=>'users');
$count = 0;
function checkMigration($condition, $message) {
    global $count;
    if (!$condition) throw new RuntimeException($message);
    $count++;
}
function migrationRows($sql) {
    global $conn;
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}
function migrationSnapshot($table) {
    global $conn;
    return array(
        'rows' => migrationRows("SELECT * FROM `$table` ORDER BY id"),
        'columns' => migrationRows("SHOW FULL COLUMNS FROM `$table`"),
        'indexes' => array_map(function ($row) { unset($row['Table']); return $row; }, migrationRows("SHOW INDEX FROM `$table`")),
        'next_id' => migrationRows("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='$table'")
    );
}
function runMigration($file) {
    global $conn;
    mysqli_query($conn, file_get_contents(__DIR__ . '/../migrations/' . $file));
}
function expectMigrationFailure($file) {
    try { runMigration($file); }
    catch (mysqli_sql_exception $exception) { checkMigration(true, 'Expected rename failure'); return; }
    throw new RuntimeException('Migration unexpectedly succeeded');
}
try {
    preg_match_all('/(?:CREATE|ALTER) TABLE `[^`]+`.*?;/s', file_get_contents(__DIR__ . '/fixtures/legacy-schema.sql'), $schema);
    foreach ($schema[0] as $statement) mysqli_query($conn, $statement);
    // Insert a representative row in every old table; parent game goes first.
    foreach (array_merge(array('jogo'), array_diff(array_keys($names), array('jogo'))) as $table) {
        $fields = array(); $values = array();
        foreach (migrationRows("SHOW COLUMNS FROM `$table`") as $column) {
            $fields[] = '`' . $column['Field'] . '`';
            if ($column['Field'] === 'id' || $column['Field'] === 'id_jogo') $values[] = '40';
            elseif ($column['Null'] === 'YES') $values[] = 'NULL';
            elseif (strpos($column['Type'], 'int') !== false) $values[] = '1';
            elseif ($column['Type'] === 'date') $values[] = "'2026-10-11'";
            elseif (strpos($column['Type'], 'char(1)') === 0) $values[] = "'F'";
            else $values[] = "'fixture'";
        }
        mysqli_query($conn, "INSERT INTO `$table` (" . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')');
    }
    $before = array();
    foreach ($names as $old => $new) $before[$old] = migrationSnapshot($old);
    // A conflict at the last target must not leave earlier tables renamed.
    mysqli_query($conn, 'CREATE TABLE users (id INT)');
    expectMigrationFailure('001_english_table_names.sql');
    foreach ($names as $old => $new) checkMigration(migrationSnapshot($old) === $before[$old], "Conflict preserves $old");
    mysqli_query($conn, 'DROP TABLE users');
    runMigration('001_english_table_names.sql');
    foreach ($names as $old => $new) checkMigration(migrationSnapshot($new) === $before[$old], "Forward preserves rows, columns, indexes and sequence of $old");
    checkMigration(count(migrationRows('SHOW TABLES')) === 9, 'Only nine renamed tables remain');
    $foreignKeys = migrationRows("SELECT REFERENCED_TABLE_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='game_states' AND COLUMN_NAME='id_jogo'");
    checkMigration($foreignKeys[0]['REFERENCED_TABLE_NAME'] === 'games', 'Foreign key follows renamed parent');
    try {
        mysqli_query($conn, 'UPDATE game_states SET id_jogo=999999 WHERE id=40');
        throw new RuntimeException('Foreign key accepted an orphan');
    } catch (mysqli_sql_exception $exception) {
        checkMigration($exception->getCode() === 1452, 'Foreign key still rejects orphan rows');
    }
    expectMigrationFailure('001_english_table_names.sql');
    foreach ($names as $old => $new) checkMigration(migrationSnapshot($new) === $before[$old], "Repeat preserves $new");
    runMigration('001_english_table_names.down.sql');
    foreach ($names as $old => $new) checkMigration(migrationSnapshot($old) === $before[$old], "Reverse preserves $old");
    echo "$count migration assertions passed.\n";
} finally {
    mysqli_query($conn, "DROP DATABASE `$database`");
    mysqli_close($conn);
}
