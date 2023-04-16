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
        include_once "../layout.php";
        include_once "../controll/crud/alterar.php";
        ?>
        <article>
            <div class="mt-5 py-5">
                <form action="" method="POST">
                    <?php
                    include_once "../controll/crud/alterar.php";
                    ?>
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
    </div>
    <footer>
        <div class="position-absolute bottom-0 start-50 translate-middle-x">
            <p>&copy;SGE 2022</p>
        </div>
    </footer>
</body>
<script src="../Myjs/script.js"></script>
<?php
if (isset($_POST['senha_nova']) && isset($_POST['senha_novamente']) && ($_POST['senha_nova'] === $_POST['senha_novamente']) && isset($_GET['user'])) :
    $id_login = $_GET['user'];
    $senha_atual = password_hash($_POST['senha_nova'], PASSWORD_DEFAULT);
    $editar->loginSenha($id_login, $senha_atual);
    echo "<script>window.location.href ='../index.php'</script>";
else :
    echo "<script>alert('Senhas incompatíveis')</script>";
endif;
?>

</html>