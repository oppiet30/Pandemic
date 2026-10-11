<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <?php
    include('headers.php');
    include('functions.php');
    if(!$_COOKIE["user"]){
        exit;
    }

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
            <h2><?php echo pandemic_text('Create game'); ?></h2>
            <form id="create_jogo">
                <div class="form-group">
                    <label for="nome"><?php echo pandemic_text('Name:'); ?></label>
                    <input type="text" class="form-control" required id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="nome"><?php echo pandemic_text('Description:'); ?></label>
                    <br>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" id="descricao"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="n_jogadores"><?php echo pandemic_text('Number of players:'); ?></label>
                    <select class="form-control" id="n_jogadores">
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="data"><?php echo pandemic_text('Game start date:'); ?></label>
                    <input type="date" class="form-control" name="data_inicio" required id="data" />
                </div>

                <input type="hidden" value="<?php echo $_COOKIE["user"] ?>" id="primeiro_user"/>


                <button id="criar_jogo" type="button" class="btn btn-default"><?php echo pandemic_text('Create'); ?></button>

            </form>
        </div>

        <div class="criar_jogo_sucesso">

        </div>


        <script>

            $('#criar_jogo').click(function () {
                var nome = $('#nome').val();
                var descricao = $('#descricao').val();
                var n_jogadores = $('#n_jogadores').val();
                var data_comeco = $('#data').val();
                var user_criador = $('#primeiro_user').val();


                if ($('#descricao').val()) {
                    var descricao = $('#descricao').val();
                } else {
                    var descricao = null;
                }

                $.ajax({

                    url: 'criar_jogo_form.php',
                    type: 'POST',
                    data: {
                        nome: nome,
                        descricao: descricao,
                        n_jogadores: n_jogadores,
                        data_comeco: data_comeco,
                        criador: user_criador,
                    },

                    success: function (msg) {
                        if (msg == "success") {
                            $('.registo').hide();
                            $('.criar_jogo_sucesso').append(<?php echo pandemic_js_markup('<div>Game created successfully!</div> <br>'); ?>);
                            $('.criar_jogo_sucesso').append(<?php echo pandemic_js_markup('<a href=\'lista_jogos.php\' id=\'botao_logout\'>View the game list</a>'); ?>);
                        } else if (msg == "duplicado") {
                            $(".erro_duplicado").append(<?php echo pandemic_js_markup('<div>A game with that name already exists.</div>'); ?>);
                        }
                    }
                });
            });

        </script>
        <script type="text/javascript">
            $('#botao_logout').click(function () {
                window.location.replace("homepage.php");
            })

        </script>

    </body>
</html>
