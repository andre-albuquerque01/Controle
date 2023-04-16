<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra cliente</title>
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
        $idLogin = $_SESSION['id_login'];
        $pesquisa = $conexao->query("SELECT t.id_tecnico FROM tecnico t INNER JOIN endereco e INNER JOIN login l ON t.login_id_login = l.id_login WHERE l.id_login = $idLogin");
        while ($tabela = $pesquisa->fetch()) :
            $id_tecnico = $tabela['id_tecnico'];
        endwhile;
        if ($id_tecnico === null) :
            echo "<script>alert('Não têm tecnico cadastrado ainda')</script>";
            echo "<script>window.location.href ='tecncio.php' </script>";
        endif;
        ?>
        <article>
            <div class="mt-5 p-5">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <label>Primeiro nome</label>
                            <input type="text" class="form-control" name="nome_completo" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Telefone</label>
                            <input type="number" class="form-control" name="telefone_celular" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Telefone residencial</label>
                            <input type="number" class="form-control" name="telefone_contato" value="(21) 12345-6789">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>E-mail</label>
                            <input type="text" name="email_cliente" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>CEP</label>
                            <input type="number" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);" placeholder="00000-000" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mx-auto">
                            <label>Endereço</label>
                            <input type="text" class="form-control" name="rua" id="rua">
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div class="form-group"><label>Estado</label>
                                <select class="form-select" name="uf" id="uf" required>
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
                            <input type="text" class="form-control" name="bairro" id="bairro" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <label>Complemento</label>
                            <input type="text" class="form-control" name="complemento">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
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
if (isset($_POST['cep']) && isset($_POST['nome_completo']) && isset($_POST['email_cliente']) && isset($_POST['telefone_celular']) && isset($_POST['rua'])) :
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $complemento = $_POST['complemento'];

    $nome_completo = $_POST['nome_completo'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_contato = $_POST['telefone_contato'];
    $email_cliente = $_POST['email_cliente'];
    $creats->cliente($cep, $cidade, $uf, $bairro, $rua, $complemento, $nome_completo, $email_cliente, $telefone_celular, $telefone_contato);
endif;
?>

</html>