<?php require_once __DIR__ . '/i18n.php';
include ('functions.php');
if (verificaLoginUser()) {
    header('Location: homepage.php');
}
?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <head>
        <title>Pandemic</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="styles/style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/language_selector.php'; ?>
        <header>
            <a href="index.php  "><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>
        <div id="logs">
            <button id="botao_login" onclick="document.getElementById('id01').style.display = 'block'"><?php echo pandemic_text('Log in'); ?></button>
            <button onclick="location.href = 'register.php'"><?php echo pandemic_text('Register'); ?></button>
        </div>

        <?php include('login.php'); ?>


    </body>
</html>
