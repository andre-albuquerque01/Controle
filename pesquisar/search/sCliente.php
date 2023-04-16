<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="../../Myjs/bootstrap.bundle.min.js"></script>
    <title>Cliente</title>
</head>

<body>
    <div class="container-sm">
        <?php
        $idDoCliente = $_GET['cliente'];
        include_once "layout.php";
        ?>
        <article>
            <div class="col-md-12 p-5 mt-5">
                <table class="table table-hover caption-top" id="tblUser">
                    <caption>Informações do cliente</caption>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">CEP</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">UF</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">Complementar</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT * FROM cliente c INNER JOIN endereco e ON c.endereco_id_endereco = e.id_endereco WHERE c.id_cliente = $idDoCliente");
                        while ($tabela = $pesquisa->fetch()) {
                            $nome = $tabela['nome_completo'];
                            $telefone = $tabela['telefone_celular'];
                            $cep = $tabela['cep'];
                            $cidade = $tabela['cidade'];
                            $uf = $tabela['uf'];
                            $rua = $tabela['rua'];
                            $bairro = $tabela['bairro'];
                            $complemento = $tabela['complemento'];
                            $id_cliente = $tabela['id_cliente'];


                        ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefone ?></td>
                                <td><?= $cep ?></td>
                                <td><?= $cidade ?></td>
                                <td><?= $uf ?></td>
                                <td><?= $rua ?></td>
                                <td><?= $bairro ?></td>
                                <td><?= $complemento ?></td>
                                <td><a href="../../editar/cliente.php?cliente=<?= $id_cliente ?>"><button class="btn btn-outline-primary">Editar</button></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
                        $pesquisa = $conexao->query("SELECT e.modelo, e.marca, e.numero, e.descricao, e.id_eletronico FROM cliente_eletronico ce INNER JOIN cliente c ON c.id_cliente = ce.cliente_id_cliente INNER JOIN eletronico e ON e.id_eletronico = ce.eletronico_id_eletronico WHERE c.id_cliente =  $idDoCliente");
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
                                <td><a href="../../editar/eletronicoReparo.php?eletronico=<?= $id_eletronico ?>"><button class="btn btn-outline-primary">Editar</button></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 p-5">
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
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = $conexao->query("SELECT r.id_reparo, r.data_recebimento, r.data_entrega, r.observacao, r.valor_total, t.nome_tecnico, s.nome_status, e.modelo, e.marca FROM `reparo` r INNER JOIN statu s ON r.status_id_status = s.id_status INNER JOIN tecnico t ON r.tecnico_id_tecnico = t.id_tecnico INNER JOIN eletronico e ON r.eletronico_id_eletronico = e.id_eletronico INNER JOIN cliente_eletronico ce ON r.eletronico_id_eletronico = ce.eletronico_id_eletronico INNER JOIN cliente c on c.id_cliente = ce.cliente_id_cliente WHERE c.id_cliente = $idDoCliente");
                        while ($tabela = $pesquisa->fetch()) {
                            $id_reparo = $tabela['id_reparo'];

                            // Eletronico
                            $modelo = $tabela['modelo'];
                            $marca = $tabela['marca'];


                            //Mudar para a data BR
                            $data1 = $tabela['data_recebimento'];
                            $data_recebimento = date('d/m/Y', strtotime($data1));
                            $data3 = $tabela['data_entrega'];
                            $data_entrega = date('d/m/Y', strtotime($data3));


                            $observacao = $tabela['observacao'];
                            $valor_total = $tabela['valor_total'];
                            //tecnico
                            $nome = $tabela['nome_tecnico'];
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
                                <td><?= $nome ?></td>
                                <td><a href="../../editar/eletronicoReparo.php?reparo=<?= $id_reparo ?>"><button class="btn btn-outline-primary">Editar</button>
                                <a href="sReparo.php?reparo=<?= $id_reparo ?>"><button class="btn btn-outline-primary">Ver</button></a></td>
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
    include_once "../../footer.php";
    ?>
</body>

</html>