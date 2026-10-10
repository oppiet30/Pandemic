<?php
require_once __DIR__ . '/../display.php';
include('../db_config.php');

if (!isset($_COOKIE['admin'])) {
    exit();
}


$query_lista = "SELECT * FROM user";


foreach ($_POST as $pesquisar => $dados) {
    if ($pesquisar == 'procurar') {
        $coluna_a_procurar = $dados;
    }
    $query_lista = "SELECT * FROM user WHERE `$coluna_a_procurar`='$dados'";
}

$result_lista = mysqli_query($conn, $query_lista) or die();
?>
<html lang="en">
    <?php include 'consts.php'; ?>
    <?php include './headers.php'; ?>
    <body>
        <table>
            <tr>
                <th>User ID</th><th>Name</th><th>Last name</th><th>Username</th><th>Email</th><th>Sex</th><th>Date of birth</th><th>Country</th><th>District</th><th>Municipality<th>Password</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result_lista)) { ?>
                <tr>
                    <?php
                    foreach ($row as $campo => $dados) {
                        if ($campo == 'pais') {
                            $display = pandemic_display($dados);
                        } elseif ($campo == 'sexo') {
                            $display = ($dados == 'm' ? 'Male' : ($dados == 'f' ? 'Female' : htmlspecialchars($dados, ENT_QUOTES, 'UTF-8')));
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
            <label for="procurar">Search by:</label>
            <select name="procurar">
                <option value="nome">Name</option>
                <option value="pais">Country</option>
            </select>
            <input type="text" name="a_procurar" />
            <button type="submit">Search</button>
        </form>
    </body>
</html>
