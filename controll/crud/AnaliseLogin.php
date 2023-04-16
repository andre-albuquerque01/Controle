<?php
include_once "conexao.php";
class Login
{
    public $conexao;
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Login do usuário em geral
    public function processa($email, $senha)
    {
        $sql = "SELECT id_login, nome_login, senha_usuario FROM login l WHERE email_usuario = :email";
        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(":email", $email);
        $stm->execute();
        $analise = $stm->fetch(PDO::FETCH_ASSOC);
        $hash = $analise['senha_usuario'];
        echo "<script>alert('$hash');</script>";

        if ($analise) {
            if (password_verify($senha, $analise['senha_usuario'])) {
                // Senha válida, fazer login
                session_start();
                $_SESSION['id_login'] = $analise['id_login'];
                $_SESSION['nome_login'] = $analise['nome_login'];
                echo "<script>alert('Informações válidas!');</script>";
                echo "<script>window.location.href ='dashboard.php' </script>";
            } else {
                // Senha inválida
                echo "<script>alert('Usuário ou Senha inválida!');</script>";
            }
        } else {
            // Usuário não encontrado
            echo "<script>alert('Usuário não encontrado!');</script>";
        }
    }

    // Login do controle
    public function processaControle($email, $senha)
    {
        $sql = "SELECT id_controle, nome_completo FROM controle WHERE email_controle = '$email' AND senha_controle = '$senha';";
        $query = $this->conexao->query($sql);
        $analise = $query->fetch();
        if ($analise) :
            if (password_verify($senha, $analise['senha_usuario'])) :
                session_start();
                $_SESSION['id_controle'] = $analise['id_controle'];
                $_SESSION['nome_completo'] = $analise['nome_completo'];
                echo "<script>alert('Informações validas!');</script>";
                echo "<script>window.location.href ='dashboardControle.php' </script>";
            else :
                echo "<script>alert('Informações invalidas!');</script>";
                echo "<script>window.location.href ='controle.php?erro' </script>";
            endif;
        else :
            echo "<script>alert('Informações invalidas!');</script>";
            echo "<script>window.location.href ='controle.php?erro' </script>";
        endif;
    }

    // Verificar a sessão, se está logado
    public function verifica()
    {
        if (!isset($_SESSION)) session_start();
        if (isset($_SESSION['id_login']) == null) :
            echo "<script>alert('Erro: Necessário realizar o login para acessar a página!');</script>";
            echo "<script>window.location.href ='index.php'</script>";
        endif;
    }
    // Verificar a sessão, se está logado
    public function verificaControle()
    {
        if (!isset($_SESSION)) session_start();
        if (isset($_SESSION['id_controle']) == null) :
            echo "<script>alert('Erro: Necessário realizar o login para acessar a página!');</script>";
            echo "<script>window.location.href ='dashboardControle.php'</script>";
        endif;
    }

    // Token de verificar o email.
    public function email()
    {
        $randEmail = sprintf('%06X', mt_rand(0, 0xFFFFFF));
        return $randEmail;
    }
}

$login = new Login($conexao);
