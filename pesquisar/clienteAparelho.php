<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <title>Cliente e aparelho</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "layout.php";
        $id_session = $_SESSION['id_login'];
        $login->verifica();
        ?>
        <article>
        <div class="col-md-12 p-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Lista dos eletronicos do cliente</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Modelo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Número do aparelho</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT e.modelo, e.marca, e.numero, e.descricao, e.id_eletronico FROM `cliente_eletronico` ce INNER JOIN cliente c ON c.id_cliente = ce.cliente_id_cliente INNER JOIN eletronico e ON e.id_eletronico = ce.eletronico_id_eletronico INNER JOIN login l ON c.login_id_login = l.id_login WHERE l.id_login = $id_session");
                        while ($tabela = $pesquisa->fetch()) {
                            $modelo = $tabela['modelo'];
                            $marca = $tabela['marca'];
                            $numero = $tabela['numero'];
                            $descricao = $tabela['descricao'];
                            $id_eletronico = $tabela['id_eletronico'];


                        ?>
                            <tr>
                                <td><?= $modelo ?></td>
                                <td><?= $marca ?></td>
                                <td><?= $numero ?></td>
                                <td><?= $descricao ?></td>
                                <td><a href="<?= $id_eletronico ?>"><button class="btn btn-outline-primary">Editar</button></a></td>
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
    include_once "../footer.php";
    ?>
</body>
<script src="../Myjs/jquery.min.js"></script>
<script type="text/javascript" src="../Myjs/datatables.min.js"></script>
<script src="../Myjs/pt-BR.json"></script>
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