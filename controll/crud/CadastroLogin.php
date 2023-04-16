<?php
include "conexao.php";
class CadastroLogin
{
    public $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    // Cadastro login
    public function login($nome_login, $nome_loja, $email_usuario, $senha_usuario, $controle_id_controle)
    {
        try {
            $sqlLogin = "INSERT INTO login (nome_login, nome_loja, email_usuario, senha_usuario, controle_id_controle) VALUES (:nome_login, :nome_loja, :email_usuario, :senha_usuario, :controle_id_controle)";
            $queryLogin = $this->conexao->prepare($sqlLogin);
            $queryLogin->bindParam(":nome_login", $nome_login);
            $queryLogin->bindParam(":nome_loja", $nome_loja);
            $queryLogin->bindParam(":email_usuario", $email_usuario);
            $queryLogin->bindParam(":senha_usuario", $senha_usuario);
            $queryLogin->bindParam(":controle_id_controle", $controle_id_controle);
            $queryLogin->execute();
            if ($queryLogin->rowCount() > 0) :
                echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                // echo "<script>window.location.href = '../dashboardControle.php'</script>";
            endif;
        } catch (PDOException $e) {
            // echo "<script>window.location.href = '../dashboardControle.php'</script>";
        }
    }
}
$creat = new CadastroLogin($conexao);
