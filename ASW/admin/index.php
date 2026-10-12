<?php require_once __DIR__ . '/../i18n.php';
include('../db_config.php');
?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <head>
        <title><?php echo pandemic_text('Pandemic: Admin'); ?></title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/../language_selector.php'; ?>
        <header>
        <!--<a href="index.php"><img id="logo" src="fundo.jpg"/></a>-->
            <h1 id="title"><?php echo pandemic_text('Administration'); ?></h1>
        </header>
        <div class="registo">
            <h2><?php echo pandemic_text('Administration'); ?></h2>
            <form action="index.php" method="post" id="registar">
                <div class="form-group">
                    <label for="nome"><?php echo pandemic_text('Name'); ?></label>
                    <input type="text" class="form-control" id="nome" placeholder="<?php echo pandemic_text('Name'); ?>" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="nome"><?php echo pandemic_text('Password'); ?></label>
                    <input type="password" class="form-control" id="password" placeholder="*****" name="password" required>
                </div>
                <button type="submit"><?php echo pandemic_text('Log in'); ?></button>
            </form>

        </div>
    </body>
</html>
<?php
if ($_COOKIE["admin"] == "") {

    if (isset($_POST['nome']) && isset($_POST['password'])) {
        $nome = $_POST['nome'];
        $password = $_POST['password'];
        $query_admin = "SELECT nome, password FROM admins WHERE nome='$nome' AND password='$password'";
        $result_query = mysqli_query($conn, $query_admin) or die();
//        while ($row = mysqli_fetch_assoc($result_query)) {
//            defineNomeAdmin($row['nome']);
//        }

// <editor-fold defaultstate="collapsed" desc="Conta o número de resultados da BD. Se > 0, existe, senão, não faz login">
        $contador_linhas = mysqli_num_rows($result_query);
        if ($contador_linhas > 0) {
            $contador_linhas = true;


            header('Location: dashboard.php');
        }
        setcookie("admin", $nome, time() + 24 * 60, "/");
    }

// </editor-fold>
} else {
    header('Location: dashboard.php');
}
?>
