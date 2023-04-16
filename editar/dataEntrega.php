<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entregar eletronico</title>
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
                    $id = $_GET['reparo'];
                    $sql = "SELECT r.id_reparo, r.data_entrega FROM `reparo` r INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN statu s on r.status_id_status = s.id_status INNER JOIN eletronico e on r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico cl ON e.id_eletronico = cl.eletronico_id_eletronico INNER JOIN cliente c ON cl.cliente_id_cliente = c.id_cliente WHERE r.id_reparo = $id";

                    // Revelar os dados do db
                    $pesquisa = $conexao->query($sql);

                    while ($linha = $pesquisa->fetch()) :
                        // Reparo
                        $data_entrega = $linha['data_entrega'];
                        // Reparo
                        $id_reparo = $linha['id_reparo'];
                    endwhile;
                    date_default_timezone_set("America/Sao_Paulo");
                    $date = date("Y-m-d");
                    ?>
                    <!-- Dados reparo -->
                    <h3 class="mt-4">Qual dia o eletronico foi entregue?</h3>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label>Data de entrega</label>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="data_entrega" value="<?php if (isset($data_entrega)) : echo $data_entrega;
                                                                                                    else : echo $date;
                                                                                                    endif; ?>" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-warning mr-1"><a href="../pesquisar/cliente.php" style="text-decoration: none; color: white; ">Cancelar</a></button>
                            </div>
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
if (isset($_POST['data_entrega'])) :
    //Informações sobre o reparo
    $data_entrega = $_POST['data_entrega'];
    $editar->dataEntrega($id_reparo,  $data_entrega);
endif;
?>

</html>