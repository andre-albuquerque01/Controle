<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['nome'];
$email = $_POST['email'];
$message = $_POST['mensagem'];
$today = date("d/m/Y");
date_default_timezone_set("America/Sao_Paulo");
$today2 = date("H:i:s");

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'sistemadegereciamentos@gmail.com';
	$mail->Password = 'sistemasge2022';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom($email, "Cliente, $name");
	$mail->addAddress('sistemadegereciamentos@gmail.com');
	/*
    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
	//Content
	$mail->isHTML(true);
	$mail->Subject = 'Email de contato';
	$mail->Body = $message . ". De $email.<p>O envio do e-mail foi no $today às $today2</p>";
	$mail->AltBody = "O envio do e-mail foi no $today às $today2";

	$mail->send();
	echo "<script>alert('Mensagem foi enviada!');</script>";
	echo "<script>location.href ='../../index.php' </script>";
} catch (Exception $e) {
	echo "<script>alert('Erro: mensagem não pode ser enviada!');</script>";
	echo "<script>location.href ='../../index.php' </script>";
}
