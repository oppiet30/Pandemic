<?php
include('../db_config.php');

if (!isset($_COOKIE['admin'])) {
    exit();
}

include './functions.php';

if (isset($_POST['procurar']) && $_POST['procurar'] != '') {
    $result_lista = pesquisaEstadoJogo($conn, $_POST['procurar']) or die();
} else {
    $result_lista = pesquisaEstadoJogo($conn) or die();
}

if (isset($_POST['a_procurar']) && $_POST['a_procurar']) {

    $campo_a_procurar = $_POST['a_procurar'];
    $valor_a_procurar = $_POST['especifico_a_procurar'];
    $result_lista = pesquisaJogoEspecifico($conn, $campo_a_procurar, $valor_a_procurar);
}
?>
<html lang="en">
    <?php include 'consts.php'; ?>
    <?php include 'headers.php'; ?>

    <body>
        <div class="container-fluid">
            <table>
                <tr>
                    <th>Game ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Number of players</th>
                    <th>Created by</th>
                    <th>Player 2</th>
                    <th>Player 3</th>
                    <th>Player 4</th>
                    <th>Created</th>
                    <th>Started</th>
                    <th>Status</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result_lista)) {

                    $vista_geral = vistaGeralJogo($row['id_jogo'], $conn);
                    foreach ($vista_geral as $vista) {
                        $criador = $vista['criador'];
                        $nome = $vista['nome'];
                        $descricao = $vista['descricao'];
                        $data_criacao = $vista['data_comeco'];
                    }

//                    }
                    ?>
                    <tr>
                        <td><?php echo $row['id_jogo'] ?></td>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $descricao ?></td>
                        <td><?php echo $row['n_jogadores'] ?></td>
                        <td><?php echo $criador ?></td>
                        <td><?php echo $row['jogador2'] ?></td>
                        <td><?php echo ($row['jogador3'] != 'NULL' ? $row['jogador3'] : "Empty") ?></td>
                        <td><?php echo ($row['jogador4'] != 'NULL' ? $row['jogador4'] : "Empty") ?></td>
                        <td><?php echo $data_criacao ?></td>
                        <td><?php echo $row['data_inicio'] ?></td>
                        <td><span class="<?php echo ($row['estado'] == 'Iniciado' ? "Verde" : "Vermelho") ?>"><?php echo pandemic_display($row['estado']) ?></span></td>


                        <?php
                    }
                    $detalhes = array();
                    ?>
                </tr>
                <?php
//                }
                ?>


            </table>
            <form action="" method="POST">
                <label for="procurar">Filter by status:</label>
                <select name="procurar">
                    <option value="">All</option>
                    <option value="Iniciado">In progress</option>
                    <option value="Desistiram">Gave up</option>
                    <option value="Derrota">Defeat</option>
                    <option value="Vitoria">Victory</option>
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <form action="" method="POST">
                <label for="procurar">Search by field:</label>
                <select name="a_procurar">
                    <option value="nome">Name</option>
                    <option value="descricao">Description</option>
                    <option value="criador">Owner</option>
                </select>
                <input type="text" name="especifico_a_procurar" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

    </body>
    <style>
        .Verde{
            color: green;
        }
        .Vermelho{
            color: red;
        }
    </style>
</html>
