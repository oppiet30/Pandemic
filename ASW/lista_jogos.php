<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <?php
    include('headers.php');
    include('functions.php');
    include("db_config.php");
    $query = "SELECT id, nome, descricao, jogadores_actuais, n_jogadores, data_comeco, criador FROM jogo";
    $dados = mysqli_query($conn, $query) or die();
    $linha = mysqli_fetch_assoc($dados); // transforma numa lista
    $total = mysqli_num_rows($dados);   //total de dados
    ?>
    <body>
        <?php include __DIR__ . '/language_selector.php'; ?>
        <header>
            <a href="index.php"><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>
        <div id="logs">
            <button id="botao_logout" href="homepage.php"><?php echo pandemic_text('Back'); ?></button>
        </div>

        <div class="registo">
            <h2><?php echo pandemic_text('Game list'); ?></h2>
            <table border="1" id="lista_jogos">
                <td class="cabecalho"><?php echo pandemic_text('Name'); ?></td>
                <td class="cabecalho"><?php echo pandemic_text('Description'); ?></td>
                <td class="cabecalho"><?php echo pandemic_text('Number of players'); ?></td>
                <td colspan="1" class="cabecalho"><?php echo pandemic_text('Created by'); ?></td>
                <td class="cabecalho"><?php echo pandemic_text('Options'); ?></td>
                <tbody>
                    <?php
                    // se o número de resultados for maior que zero, mostra os dados
                    if ($total > 0) {
                        // inicia o loop que vai mostrar todos os dados
                        do {
                            ?>

                            <tr>
                                <td><?php echo $linha['nome'] ?> </td>
                                <td><?php echo $linha['descricao'] ?> </td>
                                <td><?php echo $linha['n_jogadores'] ?></td>
                                <td><?php echo $linha['criador'] ?></td>
                                <td><a href="jogo.php?jogo=<?php echo $linha['id'] ?>"><button id="juntar_jogo" class="btn btn-success"> <?php echo pandemic_text('Join game'); ?></button></a></td>

                            </tr>

                            <?php
                            // finaliza o loop que vai mostrar os dados
                        } while ($linha = mysqli_fetch_assoc($dados));
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <script>
            $(document).ready(function () {
                var JOGOS_ACTUAIS = <?php echo $total ?>;

                window.getJOGOS_ACTUAIS = function () {
                    return JOGOS_ACTUAIS;
                };
                window.updateJOGOS_ACTUAIS = function () {
                    JOGOS_ACTUAIS = parseInt(JOGOS_ACTUAIS) + 1;
                };


                setTimeout(verificaNumeroDeJogos, 1000);
            });
            function verificaNumeroDeJogos() {
                $.ajax({
                    url: 'functions.php',
                    data: {
                        'funcao': 'verificaUltimoJogo',
                        'total_actual': getJOGOS_ACTUAIS(),
                    },
                    method: 'post',

                    success: function (msg) {
                        if (msg == 'igual') {
                            setTimeout(verificaNumeroDeJogos, 1000);
                        } else {
                            $('#lista_jogos').append(msg);
                            updateJOGOS_ACTUAIS();
                            setTimeout(verificaNumeroDeJogos, 1000);

                        }
                    }
                });
            }
        </script>
        <script type="text/javascript">
            $('#botao_logout').click(function () {
                window.location.replace("homepage.php");
            })

        </script>
    </body>
</html>
