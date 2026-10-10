<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("PHPMailer/src/SMTP.php");
require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/Exception.php");

$to = $_POST['email'];

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = "465";
$mail->isHTML();
$mail->Username = getenv("PANDEMIC_SMTP_USERNAME") ?: "";
$mail->Password = getenv("PANDEMIC_SMTP_PASSWORD") ?: "";
$mail->SetFrom("no-reply@pandemic.com");
$mail->Subject = "Password recovery";
$mail->Body = "Follow this link to reset your password: <br>
              <a href='http://localhost/Projeto/ASW/password_rec.php'>Reset password</a>";
$mail->AddAddress($to);

$mail->Send();
echo 'Password recovery email sent successfully!';

?>
