<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <table>
                <tr>
                    <th>Players</th>
                </tr>
                <tr>
                    <td><?php echo $linha['criador']; ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador2'] ? $linha['jogador2'] : "Open slot" ) ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador3'] ? $linha['jogador3'] : "Open slot" ) ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador4'] ? $linha['jogador4'] : "Open slot" ) ?></td>
                </tr>
            </table>
            <?php if (!checkPlayer($_GET['jogo'], $nickname_jogador, $conn)) { ?>
                <button class="join_game">Join this game</button>
                <?php
            }
            if ($nickname_jogador == $linha['criador'] && $linha['jogador2']) {
                ?>
                <button id="iniciar_jogo">Start game</button>
            <?php } else { ?>
                <span>Waiting for more players to join...</span>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="container-fluid">

        <div class="col-lg-5">
            <div class="row">

                <table id="tabela1">
                    <tr>
                        <th>Game name</th>
                        <th>Created by</th>
                        <th>Description</th>
                        <th>Game start</th>
                    </tr>
                    <tr>
                        <td> <?php echo $linha['nome']; ?> </td>
                        <td><?php echo $linha['criador']; ?></td>
                        <td><?php echo $linha['descricao']; ?></td>
                        <td> <?php echo $linha['data_comeco']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>