<?php
include_once 'controll/crud/conexao.php';
include_once "controll/crud/AnaliseLogin.php";
$login->verificaControle();
date_default_timezone_set("America/Sao_Paulo");
$date = date("H:i:s");
$hora_do_dia = date("H");
if (($hora_do_dia >= 00) && ($hora_do_dia <= 12)) {
    $_SESSION['horario'] = "Bom dia, ";
} else if (($hora_do_dia >= 12) && ($hora_do_dia <= 18)) {
    $_SESSION['horario'] =  "Boa tarde, ";
} else {
    $_SESSION['horario'] =  "Boa noite, ";
}
?>
<style>
    * {
        box-sizing: border-box;
    }

    #corLink {
        color: #fff;
    }

    hr {
        color: transparent;
    }
</style>
<nav class="navbar bg-secondary navbar-expand-fluid fixed-top">
    <div class="container-fluid" id="test">
        <h1 class="navbar-brand" id="corLink"><?= $_SESSION['horario'];
                                                echo $_SESSION['nome_completo'] ?></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboardControle.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="cadastro/usuario.php">Cadastrar usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="editar/usuario.php">Configuração</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="controll/crud/sair.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <hr>
</div>