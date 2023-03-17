<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
	$mail->addAddress($to['email']);
    $mail->addReplyTo($from['email'], $from['username']);
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Tanzpartnerbörse - Eine Nachricht von '. $from['username'];
    $mail->Body    = 'Hallo '. $to['username'] .',<br>
	<br>
	Du hast eine Nachricht von '. $from['username'] .' erhalten. Sie lautet:<br>
	<br>
	'. $_POST['nachricht'] .'
	<br>
	<br>
	Wenn Du darauf Antworten möchest, kannst Du einfach auf diese Mail antworten.<br>
	<br>
	Daraufhin wird deine E-Mail-Adresse für '. $from['username'] .' sichtbar.<br>
	<br>
	Wenn die Suche erfolgreich war, löscht bitte Euer Profil von der Suchen-Seite.<br>
	<br>
	Viel Spaß beim Tanzen!
	';
    
    $mail->send();
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
?>