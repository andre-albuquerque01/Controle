<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email_usuario = $_POST['email_usuario'];
$email_cliente = $_POST['email_cliente'];
$nome_loja = $_POST['nome_loja'];
$assunto = $_POST['assunto'];
$descricao = $_POST['descricao'];
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
	$mail->Port = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom($email_usuario, 'Não responda esse email');
	$mail->addAddress($email_cliente);
	$mail->addReplyTo($email_cliente, 'Information');
	$mail->addCC("cc$email_cliente");
	$mail->addBCC("bcc$email_cliente");
	/*
    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
	//Content
	$mail->isHTML(true);
	$mail->Subject = $assunto;
	$mail->Body = $descricao . ". Aguardamos a sua presença na nossa loja, <i><u>$nome_loja.</u></i><br><p> Esse email foi enviado no dia $today às $today2.</p><br> <h4>Não responda esse email</h4>";
	$mail->AltBody = ". Aguardamos a sua presença na nossa loja, $nome_loja\n. Chegou o email no dia $today às $today2. \nNão responda esse email.\n Chegou o email no dia $today às $today2.\n Não responda esse email";

	$mail->send();
	echo "<script>alert('Mensagem foi enviada!');</script>";
	echo "<script>location.href ='../../model/index.php' </script>";
	header("Location:../../model/index.php");
} catch (Exception $e) {
	echo "<script>alert('Erro: mensagem não pode ser enviada!');</script>";
	echo "<script>location.href ='../../model/index.php' </script>";
}
