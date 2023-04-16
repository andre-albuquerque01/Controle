<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="#2e8cc2">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="author" content="Marx JMoura">
  <meta name="copyright" content="Marx J. Moura">
  <meta name="description" content="Create more organized forms and making it even easier to navigate using tabs.">
  <title>Edita tecnico</title>
  <link rel="icon" href="../../images/ico/icone.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../dist/admin4b.min.css?v=2.1.0" rel="stylesheet">
  <link href="../../dist/admin4b.min.css" rel="stylesheet" type="text/css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="app">
    <div class="app-sidebar">
      <div class="sidebar-header">
      <img src="../../images/principal3.png" width="70px" alt="Imagem de entrada" ><br>
        <div class="username"><span>Bem vindo <?php session_start();
                                              echo $_SESSION['nome_completo_login']; ?>!</span> <small><?php echo $_SESSION['email_usuario']; ?></small></div>
      </div>
      <div id="sidebar-nav" class="sidebar-nav">
        <ul>
          <li><a href="../index.php"><span class="sidebar-nav-icon fa fa-rocket"></span> <span class="sidebar-nav-text">Inicio</span></a></li>
        </ul>
        <hr><span class="sidebar-nav-header">Opções</span>
        <ul>
          <li><a href="#forms" data-toggle="collapse"><span class="sidebar-nav-icon fa fa-pencil-square-o"></span> <span class="sidebar-nav-text">Cadastro</span></a>
            <ul id="forms" class="collapse" data-parent="#sidebar-nav">
              <li><a href="../forms/cadastro_cliente.php">Cliente</a></li>
              <li><a href="../forms/cadastra_tecnico.php">Tecnico</a></li>
            </ul>
          </li>
          <li><a href="#search" data-toggle="collapse"><span class="sidebar-nav-icon fa fa-search"></span> <span class="sidebar-nav-text">Pesquisar</span></a>
            <ul id="search" class="collapse" data-parent="#sidebar-nav">
              <li><a href="../../view/pesquisar/pesquisa_aparelho.php">Aparelho</a></li>
              <li><a href="../../view/pesquisar/pesquisa_cliente.php">Cliente</a></li>
              <li><a href="../../view/pesquisar/pesquisa_reparo.php">Reparo</a></li>
              <li><a href="../../view/pesquisar/pesquisa_tecnico.php">Tecnico</a></li>
              <li><a href="../../view/pesquisar/pesquisa_cliente_aparelho.php">Cliente e Aparelho</a></li>
            </ul>
          </li>
        </ul>
        <hr><span class="sidebar-nav-header">Configuração</span>
        <ul>
          <li><a href="../editar/configuracao_geral.php"><span class="sidebar-nav-icon fa fa-cog"></span> <span class="sidebar-nav-text">Configuração</span></a>
        </ul>
        <hr>
        <ul>
          <li><a href="../../controll/crud/sair.php"><span class="sidebar-nav-icon fa fa-power-off"></span>
              <span class="sidebar-nav-text">Log out</span></a></li>
        </ul>
        <hr>
        &nbsp;&nbsp;&nbsp;
        <small>Versão 1</small>
      </div>
    </div>
    <div class="app-content">
      <div class="content-header">

        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item">Editar técnico</li>
          </ol>
        </nav>
      </div>
      <div class="content-body">
        <div class="container">
          <a href="https://getbootstrap.com/docs/4.1/components/navs/#tabs"></a>
          <a href="https://getbootstrap.com/docs/4.1/components/navs/#tabs"></a>
          <a href="https://getbootstrap.com/docs/4.1/components/collapse/"></a>

          <?php
          include_once "../../controll/crud/verifica_login.php";
          $id_vindo = $_GET['id'];
          // Revelar os dados do db
          include_once '../../controll/crud/conexao.php';
          $pesquisa = $conexao->query("SELECT * FROM tecnico INNER JOIN endereco ON tecnico.endereco_id_endereco = endereco.id_endereco WHERE tecnico.id_tecnico = $id_vindo");
          while ($tabela = $pesquisa->fetch()) {
            $nome = $tabela['nome_tecnico'];
            $telefone = $tabela['telefone_tecnico'];
            $cep = $tabela['cep'];
            $cidade = $tabela['cidade'];
            $uf = $tabela['uf'];
            $bairro = $tabela['bairro'];
            $rua = $tabela['rua'];
            $complemento = $tabela['complemento'];
            $id = $tabela['id_tecnico'];
          ?>

            <form action="../../controll/crud/editar/recebe_editar_tecnico.php?id=<?= $id ?>" method="POST">
              <div class="nav-tabs-responsive">
                <div class="card">
                  <div id="tabContent" class="tab-content">
                    <div id="personal" class="tab-pane tab-pane show active">
                      <div id="personal-collapse" class="collapse show" data-parent="#tabContent">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12 col-lg-6">
                              <div class="form-group"><label>Nome completo</label> <input type="text" class="form-control" name="nome" value="<?= $nome ?>" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Telefone</label><input type="text" class="form-control" name="telefone" value="<?= $telefone ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>CEP</label> <input type="text" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);" value="<?= $cep ?>" required></div>
                              <div class="form-group"><label>Endereço</label> <input type="text" class="form-control" name="rua" id="rua" value="<?= $rua ?>" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Cidade</label> <input type="text" class="form-control" name="cidade" id="cidade" value="<?= $cidade ?>" required>
                              </div>
                              <div class="form-group"><label>Estado</label> <select class="form-control" name="uf" id="uf" value="<?= $uf ?>">
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
                          <div class="row">
                            <div class="col-12 col-lg-6">
                              <div class="form-group"><label>Bairro</label> <input type="text" class="form-control" name="bairro" id="bairro" value="<?= $bairro ?>" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Complemento</label> <input type="text" class="form-control" name="complemento" value="<?= $complemento ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group"><button type="submit" class="btn btn-primary mr-1">Salvar</button>
                <!-- <button type="reset" class="btn btn-secondary">Cancelar</button> -->
              </div>
        </div>
        </form>
      <?php
          }
      ?>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
  <script src="../../dist/admin4b.min.js" type="text/javascript"></script>
</body>

</html>