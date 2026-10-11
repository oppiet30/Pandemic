<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
  <head>
    <title><?php echo pandemic_text('Pandemic: Profile'); ?></title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>
        <?php include __DIR__ . '/language_selector.php'; ?>
<header>
<a href="index.html"><img id="logo" src="fundo.jpg"/></a>
<h1 id="title">PANDEMIC</h1>
</header>
<div class="w3-padding-64 w3-center">
  <h1><?php echo pandemic_text('User Dashboard'); ?></h1>
  <img id="avatar" class="w3-margin w3-circle" onchange="readURL(this);" src="img_avatar2.png" alt="<?php echo pandemic_text('Avatar'); ?>"/>
  <br>
  <input type="file" name="pic" accept="image/jpeg">
  <input type="submit" value="<?php echo pandemic_text('Change avatar'); ?>">

<?php
?>
</body>
</html>
