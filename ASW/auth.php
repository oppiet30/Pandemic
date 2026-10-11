<?php
/** Check credentials without side effects; preserve existing crypt() password hashes. */
function pandemic_credentials_valid($conn, $nickname, $password) {
    if (!is_string($nickname) || !is_string($password) || $nickname === '' || $password === '') {
        return false;
    }
    $stmt = mysqli_prepare($conn, 'SELECT password FROM user WHERE nickname = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $nickname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_hash);
    $found = mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $found && is_string($stored_hash) && strlen($stored_hash) > 2
        && hash_equals($stored_hash, crypt($password, $stored_hash));
}
