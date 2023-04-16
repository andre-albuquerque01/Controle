<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="Myjs/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="mt-5 mx-auto">
            <div class="col-md-4 mx-auto">
                <h2>Acessar</h2>
            </div>
            <div class="col-md-4 mx-auto">
                <?php
                include_once "controll/crud/AnaliseLogin.php";
                $erro =  "Informações invalidas!";
                if (isset($_GET['erro'])) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $erro;
                        ?>
                    </div>
                <?php
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Insira email" required>
                    </div>
            </div>
            <div class="col-md-4 mt-2 mx-auto">
                <div class="form-group">
                    <label for="pass" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="pass" name="senha" placeholder="Insira a senha" required>
                </div>
            </div>
            <div class="col-md-4 mt-2 mx-auto"><a href="EsqueceuSenha/esqueceuSenha.php" target="_blank" rel="esqueceu senha">Esqueceu a senha?</a></div>
            <div class="col-md-4 mt-3 mx-auto">
                <button type="submit" class="btn btn-outline-primary">&#10004;Entrar</button>
            </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="position-absolute bottom-0 start-50 translate-middle-x">
            <p>&copy;SGE 2022</p>
        </div>
    </footer>
</body>
<?php
if (isset($_POST['email']) && isset($_POST['senha'])) :
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if ($email == null || $senha == null) :
        echo "<script>alert('Email ou senha com campo vazio!');</script>";
    else :
        $login->processa($email, $senha);
    endif;
endif;

?>

</html>