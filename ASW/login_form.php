<?php
include('db_config.php');
require_once __DIR__ . '/auth.php';

if (pandemic_credentials_valid($conn, $_POST['nickname'] ?? null, $_POST['password'] ?? null)) {
    setcookie('user', $_POST['nickname'], time() + 8000 * 60, '/');
    echo 'autorizado';
} else {
    echo 'negado';
}
