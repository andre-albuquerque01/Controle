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
                    $id_tecnico = $_GET['id'];
                    
                    // Dados pessoais do tecncio
                    $pesquisa = $conexao->query("SELECT t.nome_tecnico, t.telefone_tecnico, e.cep, e.uf, e.cidade, e.bairro, e.rua, e.complemento FROM tecnico t INNER JOIN endereco e ON t.endereco_id_endereco = e.id_endereco WHERE t.id_tecnico = $id_tecnico");
                    while ($tabela = $pesquisa->fetch()) :
                        $nome = $tabela['nome_tecnico'];
                        $telefone = $tabela['telefone_tecnico'];
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
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-primary mr-1">Salvar</button>
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
if (isset($_POST['nome_completo']) && isset($_POST['telefone_celular'])) :
    $nome_tecnico = $_POST['nome_completo'];
    $telefone_tecnico = $_POST['telefone_celular'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $complemento = $_POST['complemento'];

    $editar->tecnico($id_tecnico, $cep, $cidade, $uf, $bairro, $rua, $complemento, $nome_tecnico, $telefone_tecnico);
endif;
?>

</html>