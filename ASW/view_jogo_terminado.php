
<div class="col-lg-12">
    <div class="container-fluid">
        <div class="col-lg-3">
        </div>

        <div class="col-lg-6">
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
                        <th>Infection rate</th>
                        <th>Outbreaks</th>
                        <th>Research stations</th>
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
                        <th class="Azul">Blue cure</th>
                        <th class="Vermelho">Red cure</th>
                        <th class="Preto">Black cure</th>
                        <th class="Amarelo">Yellow cure</th>
                    </tr>
                    <tr>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Azul', $conn) ? "<span>Discovered!</span>" : "<span>Not discovered</span>") ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Vermelho', $conn) ? "<span>Discovered!</span>" : "<span>Not discovered</span>") ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Preto', $conn) ? "<span>Discovered!</span>" : "<span>Not discovered</span>") ?></td>
                        <td><?php echo(verificaSeDoencaEstaErradicada($_GET['jogo'], 'Amarelo', $conn) ? "<span>Discovered!</span>" : "<span>Not discovered</span>") ?></td>
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
                    <span >Game over!</span>
                    <h4>The players gave up.</h4>
                    <h4>The threat of global devastation was too much to bear.</h4>
                    <h4>Better luck next time.</h4>
                </div>
            <?php } else if ($verifica_jogo['estado'] == 'Vitoria') { ?>
                <span style="color: green">Victory!</span>
                <h4>After all your hard work, humanity has a brighter future.</h4>
                <h4>But will you be ready for the next epidemic?</h4>
            <?php } else if ($verifica_jogo['estado'] == 'Derrota') { ?>
                <span style="color: green">Game over!</span>
                <h4>Despite your heroic efforts to save humanity, nature showed no mercy.</h4>
                <h4>Perhaps things could have turned out differently...</h4>
            <?php } ?>
        </div>
    </div>
</div>

