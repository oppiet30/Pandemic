<?php require_once __DIR__ . '/i18n.php'; ?>

<div class="col-lg-12">
    <div class="container-fluid">
        <div class="col-lg-3">
        </div>

        <div class="col-lg-6">
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
        <div class="col-lg-3">
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-lg-3">
        </div>

        <div class="col-lg-6">
            <div class="row">

                <table id="tabela_surtos">
                    <tr>
                        <th><?php echo pandemic_text('Infection rate'); ?></th>
                        <th><?php echo pandemic_text('Outbreaks'); ?></th>
                        <th><?php echo pandemic_text('Research stations'); ?></th>
                    </tr>
                    <tr>
                        <td><?php echo $estado_infecao['velocidade'] ?></td>
                        <td><?php echo $estado_infecao['surtos'] ?></td>
                        <td><?php echo count($centros_pesquisa) ?></td>
                    </tr>

                </table>
                <br>
                <table id="tabela_curas">
                    <tr>
                        <th class="Azul"><?php echo pandemic_text('Blue cure'); ?></th>
                        <th class="Vermelho"><?php echo pandemic_text('Red cure'); ?></th>
                        <th class="Preto"><?php echo pandemic_text('Black cure'); ?></th>
                        <th class="Amarelo"><?php echo pandemic_text('Yellow cure'); ?></th>
                    </tr>
                    <tr>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Azul', $conn) ? pandemic_markup('<span>Discovered!</span>') : pandemic_markup('<span>Not discovered</span>')) ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Vermelho', $conn) ? pandemic_markup('<span>Discovered!</span>') : pandemic_markup('<span>Not discovered</span>')) ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Preto', $conn) ? pandemic_markup('<span>Discovered!</span>') : pandemic_markup('<span>Not discovered</span>')) ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Amarelo', $conn) ? pandemic_markup('<span>Discovered!</span>') : pandemic_markup('<span>Not discovered</span>')) ?></td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="col-lg-3">
        </div>
    </div>
    <div class="container">
        <div class="col-lg-12">
            <?php if ($verifica_jogo['estado'] == 'Desistiram') { ?>
                <div class="row game_over">
                    <span ><?php echo pandemic_text('Game over!'); ?></span>
                    <h4><?php echo pandemic_text('The players gave up.'); ?></h4>
                    <h4><?php echo pandemic_text('The threat of global devastation was too much to bear.'); ?></h4>
                    <h4><?php echo pandemic_text('Better luck next time.'); ?></h4>
                </div>
            <?php } else if ($verifica_jogo['estado'] == 'Vitoria') { ?>
                <span style="color: green"><?php echo pandemic_text('Victory!'); ?></span>
                <h4><?php echo pandemic_text('After all your hard work, humanity has a brighter future.'); ?></h4>
                <h4><?php echo pandemic_text('But will you be ready for the next epidemic?'); ?></h4>
            <?php } else if ($verifica_jogo['estado'] == 'Derrota') { ?>
                <span style="color: green"><?php echo pandemic_text('Game over!'); ?></span>
                <h4><?php echo pandemic_text('Despite your heroic efforts to save humanity, nature showed no mercy.'); ?></h4>
                <h4><?php echo pandemic_text('Perhaps things could have turned out differently...'); ?></h4>
            <?php } ?>
        </div>
    </div>
</div>

