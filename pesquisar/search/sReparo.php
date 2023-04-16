<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <title>Cliente</title>
</head>

<body>
    <div class="container-sm">
        <?php
        include_once "layout.php";
        $idDoReparo = $_GET['reparo'];
        ?>
        <article>
            <div class="col-md-12 p-5 mt-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Lista dos reparos do cliente</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Data Recebimento</th>
                            <th scope="col">Data Entrega</th>
                            <th scope="col">Observacao</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Tecnico</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT r.id_reparo, r.data_recebimento, r.data_entrega, r.observacao, r.valor_total, t.nome_tecnico, s.nome_status, e.modelo, e.marca, c.nome_completo FROM `reparo` r INNER JOIN statu s ON r.status_id_status = s.id_status INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN eletronico e ON r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico ce ON r.eletronico_id_eletronico = ce.eletronico_id_eletronico INNER JOIN cliente c on c.id_cliente = ce.cliente_id_cliente WHERE r.id_reparo = $idDoReparo");
                        while ($tabela = $pesquisa->fetch()) {
                            $id_reparo = $tabela['id_reparo'];

                            // Eletronico
                            $modelo = $tabela['modelo'];
                            $marca = $tabela['marca'];

                            // Cliente
                            $nome_completo = $tabela['nome_completo'];


                            //Mudar para a data BR
                            $data1 = $tabela['data_recebimento'];
                            $data_recebimento = date('d/m/Y', strtotime($data1));
                            $data3 = $tabela['data_entrega'];
                            $data_entrega = date('d/m/Y', strtotime($data3));


                            $observacao = $tabela['observacao'];
                            $valor_total = $tabela['valor_total'];
                            //tecnico
                            $nome_tecnico = $tabela['nome_tecnico'];
                            // Status
                            $nome_status = $tabela['nome_status'];


                        ?>
                            <tr>
                                <td><?= $data_recebimento ?></td>
                                <td><?= $data_entrega ?></td>
                                <td><?= $observacao ?></td>
                                <td><?= $valor_total ?></td>
                                <td><?= $nome_status ?></td>
                                <td><?= $modelo ?></td>
                                <td><?= $marca ?></td>
                                <td><?= $nome_tecnico ?></td>
                                <td><?= $nome_completo ?></td>
                                <td><a href="../../editar/eletronicoReparo.php?reparo=<?= $id_reparo ?>"><button class="btn btn-outline-primary">Editar</button></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <a href="../../email/informaCliente.php?reparo=<?= $id_reparo ?>">O aparelho está pronto? Deseja informa o cliente?</a><br>
                <a href="../../editar/dataEntrega.php?reparo=<?= $id_reparo ?>">O aparelho já foi entregue? Qual dia?</a>
            </div>
        </article>
    </div>
    <?php
    include_once "../../footer.php";
    ?>
</body>

</html>