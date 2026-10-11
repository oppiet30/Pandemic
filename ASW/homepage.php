<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <?php
    include('headers.php');
    include('functions.php');
    ?>
    <body>
        <?php include __DIR__ . '/language_selector.php'; ?>
        <header>
            <a href="index.php"><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>
        <?php if (verificaLoginUser()) {
            ?>
            <div id="logs">
                <a href="user_dash.php"><img class="icone" src="img_avatar2.png" style="width: 100px height: 100px" alt="<?php echo pandemic_text('Avatar'); ?>"></a>
                <button id="botao_logout" href="index.php"><?php echo pandemic_text('Log out'); ?></button>
            </div>

            <div class="container">
                <div class="col-lg-12">
                    <button type="button" style="width: 500px; margin-left: 175px; margin-top: 50px;" class="btn btn-primary btn-lg" onclick="location.href = 'criar_jogo.php'"><?php echo pandemic_text('Create game'); ?></button>
                    <button type="button" style="width: 500px; margin-left: 175px;" class="btn btn-primary btn-lg" onclick="location.href = 'lista_jogos.php'"><?php echo pandemic_text('Join a game'); ?></button>
                    <button type="button" style="width: 500px; margin-left: 175px;" class="btn btn-primary btn-lg" onclick="location.href = 'meus_jogos.php'"><?php echo pandemic_text('My games'); ?></button>
                </div>
            </div>
            <?php
        } else {
            header('Location: index.php');
        }
        ?>

        <script type="text/javascript">
            $('#botao_logout').click(function () {
                window.location.replace("log_out.php");
            })

        </script>

    </body>
</html>
