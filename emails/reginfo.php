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
    $mail->setFrom('FROM@MAIL', 'FROM NAME');
	$mail->addAddress('BCC?');
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Neue TP-Registrierung';
    $mail->Body    = 'Benutzername: '. $_POST['username'] .'<br>  Alter: '. date('Y') - $_POST['jahr'] .' ('. $_POST['jahr'] .') <br><br>
    Beitrag: '. $_POST['beitrag'] .'';

    $mail->send();
	} catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>