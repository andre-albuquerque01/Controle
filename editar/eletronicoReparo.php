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
        include_once "../controll/crud/alterar.php";
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
                    <?php
                    $sql = "";
                    // Recebe dados para alterar
                    if (isset($_GET['reparo'])) :
                        $id = $_GET['reparo'];
                        $sql = "SELECT r.id_reparo, r.data_recebimento, r.data_previsao, r.data_entrega, r.observacao, r.mao_obra, r.custo_peca, r.valor_total, t.id_tecnico, t.nome_tecnico, s.id_status, s.nome_status, e.modelo, e.marca, e.numero, e.descricao FROM `reparo` r INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN statu s on r.status_id_status = s.id_status INNER JOIN eletronico e on r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico cl ON e.id_eletronico = cl.eletronico_id_eletronico INNER JOIN cliente c ON cl.cliente_id_cliente = c.id_cliente WHERE r.id_reparo = $id";
                    elseif (isset($_GET['eletronico'])) :
                        $id = $_GET['eletronico'];
                        $sql = "SELECT r.id_reparo, r.data_recebimento, r.data_previsao, r.data_entrega, r.observacao, r.mao_obra, r.custo_peca, r.valor_total, t.id_tecnico, t.nome_tecnico, s.id_status, s.nome_status, e.modelo, e.marca, e.numero, e.descricao FROM `reparo` r INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN statu s on r.status_id_status = s.id_status INNER JOIN eletronico e on r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico cl ON e.id_eletronico = cl.eletronico_id_eletronico INNER JOIN cliente c ON cl.cliente_id_cliente = c.id_cliente WHERE e.id_eletronico = $id";
                    else :
                        echo "<script>alert('Nenhuma informação passada')</script>";
                    endif;

                    // Revelar os dados do db
                    $pesquisa = $conexao->query($sql);

                    while ($linha = $pesquisa->fetch()) :
                        // Reparo
                        $data_recebimento = $linha['data_recebimento'];
                        $data_previsao = $linha['data_previsao'];
                        $data_entrega = $linha['data_entrega'];
                        $observacao = $linha['observacao'];
                        $mao_obra = $linha['mao_obra'];
                        $custo_peca = $linha['custo_peca'];
                        $valor_total = $linha['valor_total'];

                        // Tecnico
                        $id_tecnico = $linha['id_tecnico'];
                        $tecnico = $linha['nome_tecnico'];

                        // Eletronico
                        $modelo = $linha['modelo'];
                        $marca = $linha['marca'];
                        $numero = $linha['numero'];
                        $descricao = $linha['descricao'];

                        // Status
                        $id_status = $linha['id_status'];
                        $nome_status = $linha['nome_status'];

                        // Reparo
                        $id_reparo = $linha['id_reparo'];
                    endwhile;
                    date_default_timezone_set("America/Sao_Paulo");
                    $date = date("Y-m-d");
                    ?>
                    <!-- Dados eletronico -->
                    <h3>Aparelho</h3>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Modelo</label>
                            <input type="text" class="form-control" name="modelo" value="<?= $modelo ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Marca</label>
                            <input type="text" class="form-control" name="marca" value="<?= $marca ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Codigo do celular</label>
                            <input type="text" class="form-control" name="numero" value="<?= $numero ?>">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="descricao" value="<?= $descricao ?>">
                        </div>
                    </div>
                    <!-- Dados reparo -->
                    <h3 class="mt-4">Informações sobre o reparo</h3>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Data de recibimento</label>
                            <input type="date" class="form-control" name="data_recebimento" value="<?= $data_recebimento ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Data de previsão</label>
                            <input type="date" class="form-control" name="data_previsao" value="<?= $data_previsao ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Data de entrega</label>
                            <input type="date" class="form-control" name="data_entrega" value="<?php if (isset($data_entrega)) : echo $data_entrega;
                                                                                                else : echo $date;
                                                                                                endif; ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Observação</label>
                            <input type="text" class="form-control" name="observacao" value="<?= $observacao ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Mão de obra</label>
                            <input type="number" class="form-control" step="0.01" name="mao_obra" id="mao_obra" class="mao_obra" onfocus="calcular()" value="<?= $mao_obra ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Custo da peça</label>
                            <input type="number" class="form-control" step="0.01" name="custo_peca" id="custo_peca" class="custo_peca" onblur="calcular()" value="<?= $custo_peca ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Valor total</label>
                            <input type="number" class="form-control" step="0.01" onblur="calcular()" id="valor_total" value="<?= $valor_total ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Status</label> <select name="status" id="" class="form-select" require>
                                <?php
                                // Status que do reparo
                                if ($id_status == 1) :
                                ?>
                                    <option value="1" selected>Aberto</option>
                                    <option value="2">Concluído</option>
                                <?php
                                elseif ($id_status == 2) :
                                ?>
                                    <option value="2" selected>Concluído</option>
                                    <option value="1">Aberto</option>
                                <?php
                                else :
                                ?>
                                    <option value="1" selected>Aberto</option>
                                    <option value="2">Concluído</option>
                                <?php
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Técnico</label>
                            <select name="tecnico" id="" class="form-select" require>
                                <?php
                                // Tecnico do reparo
                                $consultaTecnico = $conexao->query("SELECT t.id_tecnico, t.nome_tecnico FROM `tecnico` t INNER JOIN login l on l.id_login = t.login_id_login WHERE l.id_login = $id_session");
                                while ($consulta1 = $consultaTecnico->fetch()) :
                                    $consultaIdTecnico = $consulta1['id_tecnico'];
                                    $consultaNomeTecnico = $consulta1['nome_tecnico'];
                                endwhile;
                                if ($consultaNomeTecnico == $tecnico) :
                                ?>
                                    <option value="<?= $id_tecnico ?>" selected>
                                        <?= $tecnico ?>
                                    </option>
                                    <?php
                                    if ($consultaNomeTecnico != $tecnico) :
                                    ?>
                                        <option value="<?= $consultaIdTecnico ?>">
                                            <?= $consultaNomeTecnico ?>
                                        </option>
                                    <?php
                                    endif;
                                else :
                                    ?>
                                    <option value="<?= $id_tecnico ?>" selected>
                                        <?= $tecnico ?>
                                    </option>
                                    <option value="<?= $consultaIdTecnico ?>">
                                        <?= $consultaNomeTecnico ?>
                                    </option>
                                <?php
                                endif;
                                ?>
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
if (isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['data_recebimento']) && isset($_POST['data_previsao'])) :
    //Informações sobre o reparo
    $data_recebimento = $_POST['data_recebimento'];
    $data_previsao = $_POST['data_previsao'];
    $data_entrega = $_POST['data_entrega'];
    $observacao = $_POST['observacao'];
    $mao_obra = $_POST['mao_obra'];
    $custo_peca = $_POST['custo_peca'];
    $valor_total = $mao_obra + $custo_peca;

    //Informações do eletronico
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];

    //Tecnico
    $tecnico_id_tecnico = $_POST['tecnico'];
    // Status
    $status_id_status = $_POST['status'];

    $editar->eletronicoReparo($id_reparo, $modelo, $marca, $numero, $descricao, $data_recebimento, $data_previsao, $data_entrega, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico);
endif;
?>

</html>