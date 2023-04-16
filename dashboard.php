<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="Myjs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="Myjs/script.js"></script>
</head>

<body>
    <div class="container">
        <?php
        session_start();
        $id_session = $_SESSION['id_login'];
        include_once "layout.php";
        ?>
        <article>
            <div class="col-md-12 p-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Lista dos clientes com os reparos</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nome cliente</th>
                            <th scope="col">Data da entrega</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT c.id_cliente, c.nome_completo, r.data_previsao, r.valor_total, s.nome_status, e.modelo FROM `reparo` r INNER JOIN statu s ON r.status_id_status = s.id_status INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN eletronico e ON r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico ce ON r.eletronico_id_eletronico = ce.eletronico_id_eletronico INNER JOIN cliente c on c.id_cliente = ce.cliente_id_cliente INNER JOIN login l ON c.login_id_login = l.id_login WHERE l.id_login = $id_session");
                        while ($tabela = $pesquisa->fetch()) {
                            // Cliente
                            // Id do cliente
                            $id_cliente = $tabela['id_cliente'];
                            $nome_completo = $tabela['nome_completo'];

                            // Eletronico
                            $modelo = $tabela['modelo'];


                            // Reparo
                            $data3 = $tabela['data_previsao'];
                            $data_entrega = date('d/m/Y', strtotime($data3));
                            $valor_total = $tabela['valor_total'];
                            // Status
                            $nome_status = $tabela['nome_status'];


                        ?>
                            <tr>
                                <td><?= $nome_completo ?></td>
                                <td><?= $data_entrega ?></td>
                                <td><?= $valor_total ?></td>
                                <td><?= $nome_status ?></td>
                                <td><?= $modelo ?></td>
                                <td><a href="pesquisar/search/sCliente.php?cliente=<?= $id_cliente ?>">Dados detalhados</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </article>
    </div>
    <?php
    include_once "footer.php";
    ?>
</body>
<script src="Myjs/jquery.min.js"></script>
<script type="text/javascript" src="Myjs/datatables.min.js"></script>
<script src="Myjs/pt-BR.json"></script>
<script>
    jQuery(document).ready(function() {
        $("#tblUser").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    })
</script>

</html>