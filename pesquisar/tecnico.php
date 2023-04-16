<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="../Myjs/bootstrap.bundle.min.js"></script>
    <title>Tecnico</title>
</head>

<body>
    <div class="container">
        <?php
        include_once "layout.php";
        $id_session = $_SESSION['id_login'];
        $login->verifica();
        ?>
        <article>
            <div class="col-md-12 p-2 mt-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Lista de cliente</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT t.nome_tecnico, t.telefone_tecnico, e.cidade, e.bairro, t.id_tecnico FROM tecnico t INNER JOIN endereco e ON t.endereco_id_endereco = e.id_endereco INNER JOIN login l ON t.login_id_login = l.id_login WHERE l.id_login = $id_session");
                        while ($tabela = $pesquisa->fetch()) {
                            $nome = $tabela['nome_tecnico'];
                            $telefone = $tabela['telefone_tecnico'];
                            $cidade = $tabela['cidade'];
                            $bairro = $tabela['bairro'];
                            $id_tecnico = $tabela['id_tecnico'];
                        ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefone ?></td>
                                <td><?= $cidade ?></td>
                                <td><?= $bairro ?></td>
                                <td><a href="search/sTecnico.php?tecnico=<?= $id_tecnico ?>">Dados detalhados</a></td>
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