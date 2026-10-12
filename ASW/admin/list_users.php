<?php require_once __DIR__ . '/../i18n.php';
require_once __DIR__ . '/../display.php';
include('../db_config.php');

if (!isset($_COOKIE['admin'])) {
    exit();
}


$query_lista = "SELECT * FROM users";


foreach ($_POST as $pesquisar => $dados) {
    if ($pesquisar == 'procurar') {
        $coluna_a_procurar = $dados;
    }
    $query_lista = "SELECT * FROM users WHERE `$coluna_a_procurar`='$dados'";
}

$result_lista = mysqli_query($conn, $query_lista) or die();
?>
<html lang="<?php echo pandemic_locale(); ?>">
    <?php include 'consts.php'; ?>
    <?php include './headers.php'; ?>
    <body>
        <?php include __DIR__ . '/../language_selector.php'; ?>
        <table>
            <tr>
                <th><?php echo pandemic_text('User ID'); ?></th><th><?php echo pandemic_text('Name'); ?></th><th><?php echo pandemic_text('Last name'); ?></th><th><?php echo pandemic_text('Username'); ?></th><th><?php echo pandemic_text('Email'); ?></th><th><?php echo pandemic_text('Sex'); ?></th><th><?php echo pandemic_text('Date of birth'); ?></th><th><?php echo pandemic_text('Country'); ?></th><th><?php echo pandemic_text('District'); ?></th><th><?php echo pandemic_text('Municipality'); ?><th><?php echo pandemic_text('Password'); ?></th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result_lista)) { ?>
                <tr>
                    <?php
                    foreach ($row as $campo => $dados) {
                        if ($campo == 'pais') {
                            $display = pandemic_display($dados);
                        } elseif ($campo == 'sexo') {
                            $display = ($dados == 'm' ? pandemic_text('Male') : ($dados == 'f' ? pandemic_text('Female') : htmlspecialchars($dados, ENT_QUOTES, 'UTF-8')));
                        } else {
                            $display = htmlspecialchars($dados, ENT_QUOTES, 'UTF-8');
                        }
                        echo "<td>" . $display . "</td>";
                    }
                    ?>
                </tr>
                <?php
            }
            ?>


        </table>
        <form action="" method="POST">
            <label for="procurar"><?php echo pandemic_text('Search by:'); ?></label>
            <select name="procurar">
                <option value="nome"><?php echo pandemic_text('Name'); ?></option>
                <option value="pais"><?php echo pandemic_text('Country'); ?></option>
            </select>
            <input type="text" name="a_procurar" />
            <button type="submit"><?php echo pandemic_text('Search'); ?></button>
        </form>
    </body>
</html>
