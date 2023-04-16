<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <script src="../Myjs/angular.min.js"></script>

</head>

<body>
    <div class="container">
        <?php
        include_once "layoutControle.php";
        include_once "../controll/crud/alterar.php";
        $id_controle = $_SESSION['id_controle'];
        ?>
        <article>
            <div class="mt-5 py-5">
                <form action="" method="POST">
                    <?php
                    // Dados pessoais do tecncio
                    $pesquisa = $conexao->query("SELECT c.nome_completo, c.email_controle, c.senha_controle FROM controle c WHERE id_controle = $id_controle");
                    while ($tabela = $pesquisa->fetch()) :
                        $nome_completo = $tabela['nome_completo'];
                        $email_controle = $tabela['email_controle'];
                        $senha_controle = $tabela['senha_controle'];
                    endwhile;
                    ?>
                    <div class="mt-2 py-5">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <label>Nome do controlador</label>
                                    <input type="text" class="form-control" name="nome_completo" value="<?=$nome_completo?>" required>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <label>Email do controlador</label>
                                    <input type="text" class="form-control" name="email_controle" value="<?=$email_controle?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label>Senha do controlador</label>
                                    <input type="password" class="form-control" name="senha_controle" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
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
if (isset($_POST['nome_completo']) && isset($_POST['email_controle']) && isset($_POST['senha_controle'])) :
    if (password_verify($_POST['senha_controle'], $senha_controle)) :
        $nome_completo = $_POST['nome_completo'];
        $email_controle = $_POST['email_controle'];
        $senha_controle = $_POST['senha_controle'];
        $editar->controle($id_controle, $nome_completo, $email_controle, $senha_controle);
    endif;
endif;
?>

</html>