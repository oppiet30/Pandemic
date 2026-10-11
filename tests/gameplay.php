<?php
/** Uses a newly created random database; never imports sample accounts or touches an existing database. */
$_COOKIE['pandemic_lang'] = getenv('PANDEMIC_TEST_LOCALE') ?: 'en';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) throw new ErrorException($message, 0, $severity, $file, $line);
});
$host = getenv('MYSQL_TEST_HOST');
if (!$host) throw new RuntimeException('Set MYSQL_TEST_HOST explicitly to a test MariaDB/MySQL server.');
$conn = mysqli_connect($host, getenv('MYSQL_TEST_USER') ?: 'root', getenv('MYSQL_TEST_PASSWORD') ?: '', '', (int) (getenv('MYSQL_TEST_PORT') ?: 3306));
$database = 'pandemic_test_' . bin2hex(random_bytes(6));
mysqli_query($conn, "CREATE DATABASE `$database` CHARACTER SET utf8mb4");
mysqli_select_db($conn, $database);
mysqli_set_charset($conn, 'utf8mb4');
mysqli_query($conn, "SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
$count = 0;
function expect($condition, $message) {
    global $count;
    if (!$condition) throw new RuntimeException($message);
    $count++;
}
function scalar($sql) {
    global $conn;
    return mysqli_fetch_row(mysqli_query($conn, $sql))[0];
}
function poll($id) {
    global $conn;
    ob_start(); confirmaJogoADecorrer($id, $conn); $output = ob_get_clean();
    return json_decode($output, true, 512, JSON_THROW_ON_ERROR)['estado'];
}
try {
    $dump = file_get_contents(__DIR__ . '/../asw024.sql');
    preg_match_all('/CREATE TABLE `[^`]+`.*?;/s', $dump, $schema);
    foreach ($schema[0] as $statement) mysqli_query($conn, $statement);
    preg_match_all('/ALTER TABLE `[^`]+`.*?;/s', $dump, $alterations);
    foreach ($alterations[0] as $statement) mysqli_query($conn, $statement);
    // Only board metadata is seeded. No original user/admin or historical game rows are loaded.
    foreach (array('cartas', 'cidades') as $table) {
        preg_match('/INSERT INTO `' . $table . '`.*?;/s', $dump, $seed);
        mysqli_query($conn, $seed[0]);
    }
    require __DIR__ . '/../ASW/controlos_jogo.php';
    require __DIR__ . '/../ASW/auth.php';
    for ($id = 1001; $id <= 1002; $id++) {
        mysqli_query($conn, "INSERT INTO jogo (id,n_jogadores,jogadores_actuais,descricao,nome,criador,jogador2,data_comeco) VALUES ($id,2,2,'test','game$id','alice','bob','2026-10-10')");
        comecarJogo($id, 'alice', 'bob', '', '', $conn);
    }
    expect((int) scalar('SELECT COUNT(*) FROM doencas_erradicadas') === 2, 'Each started game has a cure row');
    expect((int) scalar('SELECT COUNT(*) FROM cartas_jogador WHERE id_jogo=1001 AND ja_jogada=0') === 8, 'Initial cards work in strict SQL mode');
    expect((int) scalar('SELECT COUNT(DISTINCT id_cidade) FROM cidades_infectadas WHERE id_jogo=1001') === 9, 'Nine distinct initial cities');
    expect((int) scalar('SELECT SUM(n_doencas) FROM cidades_infectadas WHERE id_jogo=1001') === 18, 'Initial cube distribution is 3/2/1');
    expect(scalar('SELECT centros_pesquisa FROM estado_jogo WHERE id_jogo=1001') === '6,', 'Initial Atlanta research station');
    expect(poll(1001) === 'Iniciado', 'In-progress polling returns one JSON object');
    mudaTurno(1001, 1, 1, $conn, 'alice');
    expect((int) scalar('SELECT turno_jogador FROM estado_jogo WHERE id_jogo=1001') === 2, 'Turn advances to second player');
    expect((int) scalar('SELECT jogadas FROM estado_jogo WHERE id_jogo=1001') === 0, 'New turn resets actions');

    // Epidemics affect both previously infected and previously clean cities using the supplied ID.
    mysqli_query($conn, 'DELETE FROM cidades_infectadas WHERE id_jogo=1001');
    originaSurto(1001, 27, $conn);
    expect((int) scalar('SELECT n_doencas FROM cidades_infectadas WHERE id_jogo=1001 AND id_cidade=27') === 3, 'Epidemic infects requested city');
    originaSurto(1001, 27, $conn);
    expect((int) scalar('SELECT n_doencas FROM cidades_infectadas WHERE id_jogo=1001 AND id_cidade=27') === 3, 'Epidemic on existing city retains three cubes');

    // Give the second player the same five black cards in two games, at a black research station.
    mysqli_query($conn, 'DELETE FROM cartas_jogador');
    foreach (array(1001, 1002) as $id) {
        mysqli_query($conn, "UPDATE estado_jogo SET cidade_jogador2=27, centros_pesquisa='27,' WHERE id_jogo=$id");
        foreach (array(2,7,8,14,17) as $card) {
            $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cidade,cor FROM cartas WHERE id=$card"));
            insereCarta($row['cidade'], $card, $row['cor'], $id, 'bob', $conn);
        }
        mysqli_query($conn, "DELETE FROM cidades_infectadas WHERE id_jogo=$id AND cor='Preto'");
        insereNovaDoencaEmCidade($id, 27, $conn);
    }
    expect(count(separaCartasPorCor(1001, 'bob', $conn)['Preto']) === 5, 'Black cards are classified correctly');
    expect(verificaSePodeCurarDoenca(1001, 'bob', $conn), 'Second player can discover black cure');
    expect(curaDoenca(1001, 'Preto', 'bob', array(2,2,2,2,2), $conn) === false, 'Repeated card submissions are rejected');
    expect(curaDoenca(1001, 'Preto', 'bob', array(2,7,8,14,99), $conn) === false, 'Unowned cards are rejected');
    expect(curaDoenca(1001, 'Preto', 'bob', array(2,7,8,14,17), $conn), 'Valid cure succeeds');
    expect((int) scalar("SELECT Preto FROM doencas_erradicadas WHERE id_jogo=1001") === 1, 'Cure flag saved');
    expect((int) scalar("SELECT COUNT(*) FROM cidades_infectadas WHERE id_jogo=1001 AND cor='Preto'") === 0, 'Current-game cured cubes removed');
    expect((int) scalar("SELECT COUNT(*) FROM cidades_infectadas WHERE id_jogo=1002 AND cor='Preto'") === 1, 'Other-game cubes preserved');
    expect((int) scalar('SELECT SUM(ja_jogada) FROM cartas_jogador WHERE id_jogo=1002') === 0, 'Other-game cards preserved');
    expect((int) scalar('SELECT SUM(ja_jogada) FROM cartas_jogador WHERE id_jogo=1001') === 5, 'Exactly five selected cards consumed');

    mysqli_query($conn, 'UPDATE doencas_erradicadas SET Azul=1,Amarelo=1,Preto=1,Vermelho=1 WHERE id_jogo=1001');
    infectaCidades(1001, $conn); // Must terminate when no uncured cities remain.
    expect(poll(1001) === 'Vitoria', 'All four cures trigger victory');
    mysqli_query($conn, 'UPDATE estado_jogo SET cartas_biscadas=40 WHERE id_jogo=1002');
    expect(poll(1002) === 'Derrota', 'Deck limit triggers defeat with valid JSON');
    mysqli_query($conn, "UPDATE estado_jogo SET estado='Desistiram' WHERE id_jogo=1002");
    expect(poll(1002) === 'Desistiram', 'Finished states are not overwritten');

    $hash = mysqli_real_escape_string($conn, password_hash('fixture-password', PASSWORD_BCRYPT));
    mysqli_query($conn, "INSERT INTO user (id,nome,apelido,nickname,email,pais,password) VALUES (1,'Fixture','User','alice','fixture@example.invalid','Portugal','$hash')");
    expect(pandemic_credentials_valid($conn, 'alice', 'fixture-password'), 'Correct password accepted');
    expect(!pandemic_credentials_valid($conn, 'alice', 'wrong'), 'Wrong password rejected');
    expect(!pandemic_credentials_valid($conn, 'missing', 'anything'), 'Unknown user rejected');
    expect(!pandemic_credentials_valid($conn, "' OR 1=1 -- ", 'fixture-password'), 'Username is bound as data');
    expect(!pandemic_credentials_valid($conn, array('alice'), 'fixture-password'), 'Malformed credentials rejected');
    echo "$count gameplay and login assertions passed.\n";
} finally {
    mysqli_query($conn, "DROP DATABASE `$database`");
    mysqli_close($conn);
}
