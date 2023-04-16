<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <script src="../Myjs/angular.min.js"></script>

</head>

<body>
    <div class="container">
        <?php
        include_once "layout.php";
        include_once "../controll/crud/alterar.php";
        $idLogin = $_SESSION['id_login'];
        ?>
        <article>
            <div class="mt-5 py-5">
                <form action="" method="POST">
                    <?php
                    // Dados pessoais do tecncio
                    $pesquisa = $conexao->query("SELECT l.nome_login, l.nome_loja, l.email_usuario, l.senha_usuario FROM `login` l WHERE l.id_login = $idLogin");
                    while ($tabela = $pesquisa->fetch()) :
                        $nome_login = $tabela['nome_login'];
                        $nome_loja = $tabela['nome_loja'];
                        $email_usuario = $tabela['email_usuario'];
                        $senha_usuario = $tabela['senha_usuario'];
                    endwhile;
                    ?>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Nome do usuário</label>
                            <input type="text" class="form-control" name="nome_login" value="<?= $nome_login ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Nome da loja</label>
                            <input type="text" class="form-control" name="nome_loja" value="<?= $nome_loja ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Email usuário</label>
                            <input type="email" class="form-control" name="email_usuario" value="<?= $email_usuario ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Senha atual</label>
                            <input type="password" class="form-control" name="senha_atual" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <p>Caso queira troca a senha, digite abaixo a nova senha.</p>
                        <div class="col-md-6 mx-auto">
                            <label>Senha nova</label>
                            <input type="password" class="form-control" name="senha_nova">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Senha novamente</label>
                            <input type="password" class="form-control" name="senha_novamente">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
        <?php
        include_once "../footer.php";
        ?>
    </div>
</body>
<script src="../Myjs/script.js"></script>
<?php
if (isset($_POST['nome_login']) && isset($_POST['nome_loja']) && isset($_POST['email_usuario']) && !isset($_POST['senha_nova']) && !isset($_POST['senha_novamente'])) :
    if ($senha_usuario === sha1($_POST['senha_atual'])) :
        $nome_login = $_POST['nome_login'];
        $nome_loja = $_POST['nome_loja'];
        $email_usuario = $_POST['email_usuario'];
        $senha_atual = sha1($_POST['senha_atual']);
        $editar->login($idLogin, $nome_login, $nome_loja, $email_usuario, $senha_usuario);
    else :
        echo "<script>alert('Senhas incompatíveis')</script>";
    endif;
elseif (isset($_POST['nome_login']) && isset($_POST['nome_loja']) && isset($_POST['email_usuario']) && isset($_POST['senha_nova']) && isset($_POST['senha_novamente'])) :
    if ($senha_usuario === sha1($_POST['senha_atual']) && ($_POST['senha_nova'] === $_POST['senha_novamente'])) :
        $nome_login = $_POST['nome_login'];
        $nome_loja = $_POST['nome_loja'];
        $email_usuario = $_POST['email_usuario'];
        $senha_atual = sha1($_POST['senha_nova']);
        $editar->login($idLogin, $nome_login, $nome_loja, $email_usuario, $senha_atual);
    else :
        echo "<script>alert('Senhas incompatíveis')</script>";
    endif;
endif;
?>

</html>