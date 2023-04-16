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

include_once "../controll/crud/conexao.php";
$id_reparo = $_GET['reparo'];
$select = $conexao->query("SELECT e.modelo, e.marca, l.nome_loja, c.nome_completo, c.email_cliente FROM `reparo` r INNER JOIN eletronico e ON r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico ce ON r.eletronico_id_eletronico = ce.eletronico_id_eletronico INNER JOIN cliente c on c.id_cliente = ce.cliente_id_cliente INNER JOIN login l ON c.login_id_login = l.id_login WHERE r.id_reparo = $id_reparo");
while ($tabela = $select->fetch()) :
    // Aparelho
    $modelo = $tabela['modelo'];
    $marca = $tabela['marca'];
    // Cliente
    $nome_completo = $tabela['nome_completo'];
    $email_cliente = $tabela['email_cliente'];
    // Nome loja
    $nome_loja = $tabela['nome_loja'];
endwhile;

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
    $mail->addAddress($email_cliente);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Aparelho pronto';
    $mail->Body    = "<h3>Olá, $nome_completo, essa mensagem é automatica do sistema, avisando que seu aparelho está pronto.</h3>\n<h2>O $modelo - $marca, está pronto para a sua retira aqui na loja, $nome_loja</h2>\n\n<p>Esperamos pela sua vinda!!!</p>\n<h4>Obrigrado pela preferencia!</h4>\n\n<p>Não responda essa mensagem.</p>";
    $mail->AltBody = "Olá essa mensagem é automatica do sistema, avisando que seu aparelho está pronto.\nO $modelo - $marca, está pronto para a sua retira aqui na loja, $nome_loja\n\nEsperamos pela sua vinda!!!\nObrigrado pela preferencia!\n\nNão responda essa mensagem.";

    $mail->send();
    echo "<script>alert('Mensagem foi enviada!');</script>";
    echo "<script>window.location.href='../dashboard.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo "<script>alert('O email não pode ser enviado!')</script>";
    echo "<script>window.location.href='../pesquisar/search/sCliente.php'</script>";
}
