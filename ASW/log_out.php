<?php
session_start();

// Match the root path used when login_form.php sets the login cookie.
setcookie('user', '', time() - 3600, '/');
unset($_COOKIE['user']);

$_SESSION = [];
session_destroy();

header('Location: /index.php');
exit;
