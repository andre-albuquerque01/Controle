<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="#2e8cc2">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="author" content="Marx JMoura">
  <meta name="copyright" content="Marx J. Moura">
  <meta name="description" content="Create more organized forms and making it even easier to navigate using tabs.">
  <title>Edita reparo</title>
  <link rel="icon" href="../../images/ico/icone.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../dist/admin4b.min.css?v=2.1.0" rel="stylesheet">
  <link href="../../dist/admin4b.min.css" rel="stylesheet" type="text/css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script>
  function calcular() {
    var valor1 = parseFloat(document.getElementById('mao_obra').value);
    var valor2 = parseFloat(document.getElementById('custo_peca').value);
    document.getElementById('valor_total').value = parseFloat(valor1) + parseFloat(valor2);
  }
</script>

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
              <!--<li><a href="../forms/cadastro_aparelho.php">Aparelho</a></li>
              <li><a href="../forms/cadastro_reparo.php">Reparo</a></li>-->
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
          <li><a href="../editar/configuracao_geral.php  "><span class="sidebar-nav-icon fa fa-cog"></span> <span class="sidebar-nav-text">Configuração</span></a>
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
            <li class="breadcrumb-item">Editar reparo</li>
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
          include_once '../../controll/crud/conexao.php';
          $id = $_GET['id'];
          // Revelar os dados do db
          $pesquisa = $conexao->query("SELECT * FROM `reparo` INNER JOIN tecnico ON reparo.tecnico_id_tecnico = tecnico.id_tecnico 
          INNER JOIN statu on reparo.status_id_status = statu.id_status 
          INNER JOIN eletronico on reparo.eletronico_id_eletronico = eletronico.id_eletronico 
          INNER JOIN cliente_eletronico ON eletronico.id_eletronico = cliente_eletronico.eletronico_id_eletronico 
          INNER JOIN cliente ON cliente_eletronico.cliente_id_cliente = cliente.id_cliente 
          WHERE  id_reparo = " . $id);

          while ($linha = $pesquisa->fetch()) {
            //Mudar para a data BR
            $data_converse1 = $linha['data_recebimento'];
            //$data_converse1 = date('d/m/Y', strtotime($data_converse1));
            //Mudar para a data BR
            $data_converse2 = $linha['data_previsao'];
            //$data_converse2 = date('d/m/Y', strtotime($data_converse2));
            //Mudar para a data BR
            $data_converse3 = $linha['data_entrega'];
            //$data_converse3 = date('d/m/Y', strtotime($data_converse3));
            $observacao = $linha['observacao'];
            $mao_obra = $linha['mao_obra'];
            $custo_peca = $linha['custo_peca'];
            $valor_total = $linha['valor_total'];
            $id_tecnico = $linha['id_tecnico'];
            $tecnico = $linha['nome_tecnico'];

            $modelo = $linha['modelo'];
            $id_eletronio = $linha['id_eletronico'];
            $nome_status = $linha['nome_status'];
            $id_status = $linha['id_status'];
          ?>

            <div class="nav-tabs-responsive">
              <div class="card">
                <form action="../../controll/crud/editar/recebe_editar_reparo.php?id=<?= $id ?>&aparelho=<?= $id_eletronio ?>" method="post">
                  <div id="tabContent" class="tab-content">
                    <div id="account" class="tab-pane show active"><a href="#account-collapse" class="nav-link-collapse" data-toggle="collapse"><i class="fa fa-lock mr-2"></i>
                        Reparo</a>
                      <div id="account-collapse" class="collapse show" data-parent="#tabContent">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Data de recibimento</label>
                                <input type="date" class="form-control" name="data_recebimento" value="<?= $data_converse1 ?>" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Data de previsão</label> <input type="date" class="form-control" name="data_previsao" value="<?= $data_converse2 ?>" required></div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-lg-6">
                              <div class="form-group"><label>Data de entrega</label> <input type="date" class="form-control" name="data_entrega" value="<?= $data_converse3 ?>">
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Observação</label><input type="text" class="form-control" name="observacao" value="<?= $observacao ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Mão de obra</label> <input type="number" class="form-control" step="0.01" name="mao_obra" id="mao_obra" class="mao_obra" onfocus="calcular()" value="<?= $mao_obra ?>" required></div>
                              <div class="form-group"><label>Custo da peça</label> <input type="number" class="form-control" step="0.01" name="custo_peca" id="custo_peca" class="custo_peca" onblur="calcular()" value="<?= $custo_peca ?>" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group"><label>Valor total</label> <input type="number" class="form-control" step="0.01" onblur="calcular()" id="valor_total" required>
                              </div>
                              <div class="form-group"><label>Status</label> <select name="status" class="form-control" required>
                                  <?php
                                  $status = $conexao->query("SELECT * FROM statu");
                                  while ($consulta = $status->fetch()) { ?>
                                    <option value="<?= $consulta['id_status'] ?>">
                                      <?= $consulta['nome_status'] ?>
                                    </option>
                                  <?php }    ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-lg-6">
                              <div class="form-group">
                                <label>Técnico</label> <select name="id_tecnico" class="form-control" required>
                                  <?php
                                  $id_session = $_SESSION['id_login'];
                                  $id_tecnico = $conexao->query("SELECT * FROM tecnico INNER JOIN endereco ON tecnico.endereco_id_endereco = endereco.id_endereco 
                                  INNER JOIN login ON tecnico.login_id_login = login.id_login WHERE tecnico.login_id_login = $id_session");
                                  while ($consulta1 = $id_tecnico->fetch()) { ?>
                                    <option value="<?= $consulta1['id_tecnico'] ?>">
                                      <?= $consulta1['nome_tecnico'] ?>
                                    </option>
                                  <?php }    ?>
                                </select>

                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Aparelho</label><input type="text" class="form-control" name="eletronico" value="<?= $modelo ?>" required>
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
      </div>
      </form>
    <?php
          }
    ?>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
  <script src="../../dist/admin4b.min.js" type="text/javascript"></script>
</body>

</html>