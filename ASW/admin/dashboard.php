<?php require_once __DIR__ . '/../i18n.php';
if (!isset($_COOKIE['admin'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">

    <?php include('consts.php'); ?>
    <body>
        <?php include __DIR__ . '/../language_selector.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-md-1">
                </div>

                <div class="col-lg-1 col-md-1">
                    <div class="user"><?php echo pandemic_text('Welcome,'); ?> <?php echo $_COOKIE['admin'] ?>!</div>

                </div>
            </div>
        </div>

        <div class="container conteudo">
            <div class="row>">
                <div class="col-lg-2 col-md-2" >
                    <div class="row">
                        <a href="list_users.php"><button class="botaoMenu"><?php echo pandemic_text('List users'); ?></button></a>
                    </div>
                    <div class="row">
                        <a href="list_jogos.php"><button class="botaoMenu"><?php echo pandemic_text('List games'); ?></button></a>
                    </div>

                </div>

            </div>

        </div>
    </body>

</html>

