<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do eletronico</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <script src="../Myjs/angular.min.js"></script>

</head>

<body>
    <div class="container">
        <?php
        include_once "layout.php";
        include_once "../controll/crud/cadastro.php";
        $id_session = $_SESSION['id_login'];
        ?>
        <article>
            <div class="mt-5 py-5">
                <?php
                if (isset($_GET['erro_cad'])) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_GET['erro_cad'];
                        ?>
                    </div>
                <?php
                }
                date_default_timezone_set("America/Sao_Paulo");
                $date = date("Y-m-d");
                ?>
                <form method="POST">
                    <h3>Aparelho</h3>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Modelo</label>
                            <input type="text" class="form-control" name="modelo" require>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Marca</label>
                            <input type="text" class="form-control" name="marca" require>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Codigo do celular</label>
                            <input type="text" class="form-control" name="numero">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="descricao">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-primary">Salvar</button>
                        </div>
                    </form>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-warning mr-1"><a href="../pesquisar/cliente.php" style="text-decoration: none; color: white; ">Cancelar</a></button>
                    </div>
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
if (isset($_POST['modelo']) && isset($_POST['marca'])) {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    // $cliente_id_cliente = $_GET['id'];
    $cliente_id_cliente = 43;

    $creats->eletronico($modelo, $marca, $numero, $descricao, $cliente_id_cliente);
} else {
    $_GET['erro_cad'] = "Campos não preenchidos";
}
?>

</html>