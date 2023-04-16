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
        $id_session = $_SESSION['id_controle'];
        include_once "layoutControle.php";
        ?>
        <article>
            <div class="col-md-12 p-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Lista dos clientes com os reparos</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nome usuário</th>
                            <th scope="col">Nome da loja</th>
                            <th scope="col">Email do usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT l.nome_login, l.nome_loja, l.email_usuario FROM login l WHERE l.controle_id_controle = $id_session");
                        while ($tabela = $pesquisa->fetch()) {
                            $nome_login = $tabela['nome_login'];
                            $nome_loja = $tabela['nome_loja'];
                            $email_usuario = $tabela['email_usuario'];
                        ?>
                            <tr>
                                <td><?= $nome_login ?></td>
                                <td><?= $nome_loja ?></td>
                                <td><?= $email_usuario ?></td>
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