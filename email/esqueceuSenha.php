<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require "lib/vendor/autoload.php";
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


require_once "../controll/crud/AnaliseLogin.php";
include_once "../controll/crud/conexao.php";
$email = $_POST['email'];
$token = $login->email();
$select = $conexao->query("SELECT l.email_usuario, l.id_login from `login` l WHERE l.email_usuario = '$email'");
$sel = $select->fetch();
$login = $sel['id_login'];
if ($login != null) :
    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username = 'sistemadegereciamentos@gmail.com';
        $mail->Password = 'llqcuuxsrhqhqjsn';                             //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sistemadegereciamentos@gmail.com', 'Suporte');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recupera senha';
        $mail->Body    = "<h3>Olá essa mensagem é automatica do sistema, para recuperação de sua senha.</h3>\n<h2>Use o token para validar, esse token inspira em 5 minutos</h2>\n<h1>$token</h1>\n<p>Clique no link e será redirecionado e poder trocar a senha. <a href='Controle-de-trafico-de-dispensa/EsqueceuSenha/token.php?user=$login' target='_blank' >Alterar a senha</a></p>\n\n<p>Não responda essa mensagem.</p>";
        $mail->AltBody = "Olá essa mensagem é automatica do sistema, para recuperação de sua senha.\n>Use o token para validar, esse token inspira em 5 minutos\necho $token\nClique no link e será redirecionado e poder trocar a senha. <a href='Controle-de-trafico-de-dispensa/EsqueceuSenha/token.php?user=$login' target='_blank' >Alterar a senha</a>\n\nNão responda essa mensagem.";

        $mail->send();
        echo "<script>alert('Mensagem foi enviada!');</script>";
        echo "<script>window.location.href='../EsqueceuSenha/token.php'</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo "<script>alert('O email não pode ser enviado!')</script>";
        echo "<script>window.location.href='../index.php'</script>";
    }
else :
    echo "<script>alert('Email não cadastrado!')</script>";
    echo "<script>window.location.href='../index.php'</script>";
endif;
