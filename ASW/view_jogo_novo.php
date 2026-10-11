<?php require_once __DIR__ . '/i18n.php'; ?>
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <table>
                <tr>
                    <th><?php echo pandemic_text('Players'); ?></th>
                </tr>
                <tr>
                    <td><?php echo $linha['criador']; ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador2'] ? $linha['jogador2'] : pandemic_text('Open slot') ) ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador3'] ? $linha['jogador3'] : pandemic_text('Open slot') ) ?></td>
                </tr>
                <tr>
                    <td><?php echo ($linha['jogador4'] ? $linha['jogador4'] : pandemic_text('Open slot') ) ?></td>
                </tr>
            </table>
            <?php if (!checkPlayer($_GET['jogo'], $nickname_jogador, $conn)) { ?>
                <button class="join_game"><?php echo pandemic_text('Join this game'); ?></button>
                <?php
            }
            if ($nickname_jogador == $linha['criador'] && $linha['jogador2']) {
                ?>
                <button id="iniciar_jogo"><?php echo pandemic_text('Start game'); ?></button>
            <?php } else { ?>
                <span><?php echo pandemic_text('Waiting for more players to join...'); ?></span>
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
                        <th><?php echo pandemic_text('Game name'); ?></th>
                        <th><?php echo pandemic_text('Created by'); ?></th>
                        <th><?php echo pandemic_text('Description'); ?></th>
                        <th><?php echo pandemic_text('Game start'); ?></th>
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
