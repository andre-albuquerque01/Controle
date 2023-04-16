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
                date_default_timezone_set("America/Sao_Paulo");
                $date = date("Y-m-d");
                ?>
                <form method="POST">
                    <!-- Dados eletronico -->
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
                    <!-- Dados reparo -->
                    <h3 class="mt-4">Informações sobre o reparo</h3>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Data de recebimento</label>
                            <input type="date" class="form-control" name="data_recebimento" value="<?= $date ?>" require>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Data de previsão</label>
                            <input type="date" class="form-control" name="data_previsao" require>
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
                        <div class="col-md-1">
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
if (isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['data_recebimento']) && isset($_POST['id_tecnico'])) :
    // Dados do eletronico
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];

    // Cliente
    $cliente_id_cliente = $_GET['id'];

    // Dados do reparo
    $data_recebimento = $_POST['data_recebimento'];
    $data_previsao = $_POST['data_previsao'];
    $observacao = $_POST['observacao'];
    $mao_obra = $_POST['mao_obra'];
    $custo_peca = $_POST['custo_peca'];
    $valor_total = $mao_obra + $custo_peca;
    //Status
    $status_id_status = $_POST['status'];
    //Tecnico
    $tecnico_id_tecnico = $_POST['id_tecnico'];

    $creats->adicionar($modelo, $marca, $numero, $descricao, $cliente_id_cliente, $data_recebimento, $data_previsao, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico);
endif;
?>

</html>