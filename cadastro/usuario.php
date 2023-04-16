<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra tecnico</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <script src="../Myjs/angular.min.js"></script>

</head>

<body>
    <div class="container">
        <?php
        include_once "layoutControle.php";
        include_once "../controll/crud/CadastroLogin.php";
        ?>
        <article>
            <div class="mt-5 py-5">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Nome usuário</label>
                            <input type="text" class="form-control" name="nome_login" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Nome loja</label>
                            <input type="text" class="form-control" name="nome_loja" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Email usuário</label>
                            <input type="email" class="form-control" name="email_usuario" id="email_usuario" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Senha do usuário</label>
                            <input type="password" class="form-control" name="senha_usuario" id="senha_usuario" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    </article>
    <?php
    include_once "../footer.php";
    ?>
    </div>
</body>
<script src="../Myjs/script.js"></script>
<?php
$controle_id_controle = $_SESSION['id_controle'];
if (isset($_POST['email_usuario']) && isset($_POST['nome_loja']) && isset($_POST['senha_usuario'])) :
    $nome_login = $_POST['nome_login'];
    $nome_loja = $_POST['nome_loja'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT);
    $creat->login($nome_login, $nome_loja, $email_usuario, $senha_usuario, $controle_id_controle);
    echo "<script>window.location.href = '../dashboardControle.php'</script>";
endif;
?>

</html>