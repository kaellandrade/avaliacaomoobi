<?php

use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Model\Usuario;

/** @var $oUsuario Usuario */
$oUsuario = $aDados['usuario'];
$bAdmin = Sistema::getUsuario()->isAdministrador();
?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Rubik+Moonrocks&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/styles/index.php.css">

    <title><?php (isset($aDados['titulo']) ? print $aDados['titulo'] : print '') ?></title>
</head>
<body>
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="empresaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="empresaModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete-form" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="inputHidden">
                        <label for="recipient-name" class="col-form-label">
                            Realmente deseja excluir <strong id="nome"></strong> ?
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-danger">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div     class="container-fluid">
        <a class="navbar-brand" href="/painel"><i
                    class="bi bi-gear-wide-connected"></i> Sindicato Trainee</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill"></i> Filiados
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/cadastro/filiado">Cadastrar Filiados</a></li>
                        <li><a class="dropdown-item" href="/visualizar/filiados?pagina=1">Listar/Editar Filiados</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-earmark-pdf"></i> Gerar Relatórios</i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/relatorio/aniversariantes"><i class="bi bi-emoji-laughing"></i> Filiados
                                aniversariantes.</a></li>
                        <li><a class="dropdown-item" href="/relatorio/totaldependentes"><i class="bi bi-list-ol"></i> Numero de dependentes por
                                filiados.</a></li>
                    </ul>
                </li>

                <?php if ($bAdmin) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-lines-fill"></i> Usuários
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/cadastro/usuario">Cadastrar Usuários</a></li>
                            <li><a class="dropdown-item" href="/listar/usuarios">Listar/Editar Usuários</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="/cadastro/empresa"><i class="bi bi-building"></i> Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cadastro/situacao"><i class="bi bi-info-circle"></i> Situações</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/cadastro/cargo"><i class="bi bi-briefcase-fill"></i> Cargos</a>
                </li>
            </ul>
            <span class="navbar-text">

                <a class="link-danger" href="/sair"> <i class="bi bi-box-arrow-left"></i></a>
                <span> <i class="bi bi-person"></i>  <?php echo $oUsuario->getSLogin() ?> </span>

            </span>
        </div>
    </div>
</nav>