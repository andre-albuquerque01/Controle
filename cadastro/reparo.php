<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do reparo</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <script src="../Myjs/angular.min.js"></script>

</head>

<body>
    <div class="container">
        <?php
        include_once "layout.php";
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
                <form action="" method="POST">
                    <h3 class="mt-4">Informações sobre o reparo</h3>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Data de recebimento</label>
                            <input type="date" class="form-control" name="data_recebimento" value="<?= $date ?>" require>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Data de previsão</label>
                            <input type="date" class="form-control" name="DataPrevisao" require>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Observação</label>
                            <input type="text" class="form-control" name="observacao">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Mão de obra</label>
                            <input type="number" class="form-control" step="0.01" name="mao_obra" id="mao_obra" class="mao_obra" onfocus="calcular()" require>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Custo da peça</label>
                            <input type="number" class="form-control" step="0.01" name="custo_peca" id="custo_peca" class="custo_peca" onblur="calcular()" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Valor total</label>
                            <input type="number" class="form-control" step="0.01" onblur="calcular()" id="valor_total" disabled required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Status</label> <select name="status" id="" class="form-select" require>
                                <?php
                                include_once '../../crud/conexao.php';
                                $status = $conexao->query("SELECT * FROM statu");
                                while ($consulta = $status->fetch()) { ?>
                                    <option value="<?= $consulta['id_status'] ?>">
                                        <?= $consulta['nome_status'] ?>
                                    </option>
                                <?php }    ?>
                            </select>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Técnico</label>
                            <select name="id_tecnico" id="" class="form-select" require>
                                <?php
                                $id_tecnico = $conexao->query("SELECT t.id_tecnico, t.nome_tecnico FROM `tecnico` t INNER JOIN login l on l.id_login = t.login_id_login WHERE l.id_login = $id_session");
                                while ($consulta1 = $id_tecnico->fetch()) { ?>
                                    <option value="<?= $consulta1['id_tecnico'] ?>">
                                        <?= $consulta1['nome_tecnico'] ?>
                                    </option>
                                <?php }    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
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
if (isset($_GET['id']) && isset($_POST['data_recebimento'])) {
    $data_recebimento = $_POST['data_recebimento'];
    $data_previsao = $_POST['DataPrevisao'];
    $data_entrega = $_POST['dataEntrega'];
    $observacao = $_POST['observacao'];
    $mao_obra = $_POST['mao_obra'];
    $custo_peca = $_POST['custo_peca'];
    $valor_total = $mao_obra + $custo_peca;
    //Status
    $status_id_status = $_POST['status'];
    //Tecnico
    $tecnico_id_tecnico = $_POST['id_tecnico'];
    // $cliente_id_cliente = $_GET['id'];
    $eletronico_id_eletronico = 43;

    $creats->reparo($data_recebimento, $data_previsao, $data_entrega, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico, $eletronico_id_eletronico);
} else {
    $_SESSION['erro_cad'] = "Campos não preenchidos";
}
?>

</html>