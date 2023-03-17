<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->setLanguage('de', 'vendor/phpmailer/phpmailer/language/');
    $mail->CharSet    = 'UTF-8';
    $mail->Host       = 'SET_THIS';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'SET_THIS';
    $mail->Password   = 'SET_THIS';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    // Receipent
    $mail->setFrom('FROM@MAIL', 'FROM MAIL');
	$mail->addAddress($email);
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Tanzpartnerbörse - Password-Code';
    $mail->Body    = 'Hallo ' . $_SESSION['name'] . ',<br><br>Der Code zum zurücksetzen des Passwortes ist: ' . $code . '.<br><br>Freundliche Grüße';
    $mail->AltBody = 'Hallo, Der Code zum zurücksetzen des Passwortes ist: ' . $code;

    $mail->send();
	} catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>