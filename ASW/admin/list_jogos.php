<?php require_once __DIR__ . '/../i18n.php';
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
<html lang="<?php echo pandemic_locale(); ?>">
    <?php include 'consts.php'; ?>
    <?php include 'headers.php'; ?>

    <body>
        <?php include __DIR__ . '/../language_selector.php'; ?>
        <div class="container-fluid">
            <table>
                <tr>
                    <th><?php echo pandemic_text('Game ID'); ?></th>
                    <th><?php echo pandemic_text('Name'); ?></th>
                    <th><?php echo pandemic_text('Description'); ?></th>
                    <th><?php echo pandemic_text('Number of players'); ?></th>
                    <th><?php echo pandemic_text('Created by'); ?></th>
                    <th><?php echo pandemic_text('Player 2'); ?></th>
                    <th><?php echo pandemic_text('Player 3'); ?></th>
                    <th><?php echo pandemic_text('Player 4'); ?></th>
                    <th><?php echo pandemic_text('Created'); ?></th>
                    <th><?php echo pandemic_text('Started'); ?></th>
                    <th><?php echo pandemic_text('Status'); ?></th>
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
                        <td><?php echo ($row['jogador3'] != 'NULL' ? $row['jogador3'] : pandemic_text('Empty')) ?></td>
                        <td><?php echo ($row['jogador4'] != 'NULL' ? $row['jogador4'] : pandemic_text('Empty')) ?></td>
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
                <label for="procurar"><?php echo pandemic_text('Filter by status:'); ?></label>
                <select name="procurar">
                    <option value=""><?php echo pandemic_text('All'); ?></option>
                    <option value="Iniciado"><?php echo pandemic_text('In progress'); ?></option>
                    <option value="Desistiram"><?php echo pandemic_text('Gave up'); ?></option>
                    <option value="Derrota"><?php echo pandemic_text('Defeat'); ?></option>
                    <option value="Vitoria"><?php echo pandemic_text('Victory'); ?></option>
                </select>
                <button type="submit" class="btn btn-primary"><?php echo pandemic_text('Search'); ?></button>
            </form>
            <form action="" method="POST">
                <label for="procurar"><?php echo pandemic_text('Search by field:'); ?></label>
                <select name="a_procurar">
                    <option value="nome"><?php echo pandemic_text('Name'); ?></option>
                    <option value="descricao"><?php echo pandemic_text('Description'); ?></option>
                    <option value="criador"><?php echo pandemic_text('Owner'); ?></option>
                </select>
                <input type="text" name="especifico_a_procurar" />
                <button type="submit" class="btn btn-primary"><?php echo pandemic_text('Search'); ?></button>
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
