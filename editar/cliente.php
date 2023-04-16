<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
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
        ?>
        <article>
            <div class="mt-5 py-5">
                <form action="" method="POST">
                    <?php
                    include_once "../controll/crud/alterar.php";
                    // Receber qual id que será editado
                    $id_cliente = $_GET['cliente'];

                    // Dados pessoais do cliente
                    $pesquisa = $conexao->query("SELECT c.nome_completo, c.email_cliente, c.telefone_celular, c.telefone_contato, e.cep, e.uf, e.cidade, e.bairro, e.rua, e.complemento FROM cliente as c INNER JOIN endereco as e ON c.endereco_id_endereco = e.id_endereco INNER JOIN login as l ON c.login_id_login = l.id_login WHERE c.id_cliente = $id_cliente");
                    while ($tabela = $pesquisa->fetch()) :
                        $nome = $tabela['nome_completo'];
                        $email_cliente = $tabela['email_cliente'];
                        $telefone = $tabela['telefone_celular'];
                        $telefone_contato = $tabela['telefone_contato'];
                        $cep = $tabela['cep'];
                        $uf = $tabela['uf'];
                        $cidade = $tabela['cidade'];
                        $bairro = $tabela['bairro'];
                        $rua = $tabela['rua'];
                        $complemento = $tabela['complemento'];
                    endwhile;
                    ?>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Primeiro nome</label>
                            <input type="text" class="form-control" name="nome_completo" value="<?= $nome ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Telefone</label>
                            <input type="number" class="form-control" name="telefone_celular" value="<?= $telefone ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Telefone residencial</label>
                            <input type="number" class="form-control" name="telefone_contato" value="<?= $telefone_contato ?>">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>E-mail</label>
                            <input type="text" name="email_cliente" class="form-control" value="<?= $email_cliente ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>CEP</label>
                            <input type="number" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);" placeholder="00000-000" value="<?= $cep ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?= $cidade ?>" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Endereço</label>
                            <input type="text" class="form-control" name="rua" value="<?= $rua ?>" id="rua">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-select" name="uf" id="uf" value="<?= $uf ?>" required>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" value="<?= $bairro ?>" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Complemento</label>
                            <input type="text" class="form-control" name="complemento" value="<?= $complemento ?>">
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
if (isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['uf']) && isset($_POST['bairro']) && isset($_POST['email_cliente'])) :
    $nome_cliente = $_POST['nome_completo'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_contato = $_POST['telefone_contato'];
    $email_cliente = $_POST['email_cliente'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $editar->cliente($id_cliente, $nome_cliente, $email_cliente, $telefone_celular, $telefone_contato, $cep, $cidade, $uf, $bairro, $rua, $complemento);
endif;
?>

</html>