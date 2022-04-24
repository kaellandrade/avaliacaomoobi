<?php

use Micaelandrade\Avaliacao\View\ViewListagemFiliado;

?>
<section class="filiados">

    <div class="container">
        <div class="modal fade" id="modalFiliado" tabindex="-1" aria-labelledby="modalFiliadoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFiliadoLabel">Adicionar dependentes para <strong
                                    id="nomeFiliado"></strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="dependente-form" method="get">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="dependente-nome" class="col-form-label">Nome</label>
                                <input name="nome" type="text" class="nome form-control" id="dependente-nome">
                                <input type="hidden" name="idFiliado" id="idFiliadoHidden">

                            </div>
                            <div class="mb-3">
                                <div class="mb-4">
                                    <label for="grau-parentesco">Grau de Parentesco</label>
                                    <select name="grauDeparentesco" id="grau-parentesco" class="form-control">
                                        <optgroup label="Grau 1">
                                            <option value="1" name="1" selected>Filho</option>
                                            <option value="1" name="1">Mãe</option>
                                            <option value="1" name="1">Pai</option>
                                            <option value="1" name="1">Irmão</option>
                                        </optgroup>
                                        <optgroup label="Grau 2">
                                            <option value="2" name="2" selected>Avô(ó)</option>
                                            <option value="2" name="2">Neto</option>
                                            <option value="2" name="2">Filhos do Conjuge</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="data-nascimento-filiado">Data nascimento dependente</label>
                                <input name="nascimento" type="date" class="form-control"
                                       id="data-nascimento-filiado" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Vincular</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
                <div class="jumbotron bg-light mb-4 mt-4 p-4">
                    <div class="row">
                        <h1 class="display-6">Lista dos filiados.</h1>
                        <p class="lead">Você também pode aplicar filtros.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="formulario-filtro">
                    <form action="/filiado/filtro" method="get" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="name-filter" class="form-label">Nome</label>
                            <input name="nome" type="text" class="form-control nome" id="name-filter" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="data-inicio" class="form-label">Data Inicio</label>
                            <input name="dataInicio" type="date" class="form-control" id="data-inicio" value=""
                                   required>
                        </div>
                        <div class="col-md-4">
                            <label for="data-fim" class="form-label">Data Fim</label>
                            <input name="dataFim" type="date" class="form-control" id="data-fim" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input name="checkName" class="form-check-input" type="checkbox" value="true"
                                       id="nome-checkbox" required>
                                <label class="form-check-label" for="nome-checkbox">
                                    Filtrar por nome
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="checkDate" class="form-check-input" type="checkbox" value="true"
                                       id="data-checkbox" required>
                                <label class="form-check-label" for="data-checkbox">
                                    Filtrar por data
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn-filter btn btn-sm btn-primary disabled" type="submit">Aplicar <i
                                        class="bi bi-funnel"></i></button>
                            <a href="/visualizar/filiados" class="btn btn-sm btn-warning" type="submit">Limpar <i
                                        class="bi bi-funnel"></i></a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (!empty($aDados['mensagem'])) {
            ?>
            <div class="alert alert-<?php echo $aDados['mensagem']['status'] ?> > alert-dismissible fade show"
                 role="alert">
                <strong><?php echo $aDados['mensagem']['titulo'] ?></strong>
                <?php echo $aDados['mensagem']['conteudo'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div class="row">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><i class="bi bi-person"></i> Nome</th>
                    <th scope="col"><i class="bi bi-telephone"></i> Celular</th>
                    <th scope="col"><i class="bi bi-calendar-check"></i> Data Nascimento</th>
                    <th scope="col"><i class="bi bi-pencil-square"></i>Editar</th>
                    <th scope="col"><i class="bi bi-person-x"></i> Remover</th>
                    <th scope="col"><i class="bi bi-people"></i> Dependente</th>
                    <th scope="col"><i class="bi bi-people"></i> Ver dependents</th>

                </tr>
                </thead>
                <tbody>
                <?php ViewListagemFiliado::renderTable($aDados['filiados']); ?>
                </tbody>
            </table>
        </div>

    </div>
    <nav aria-label="Page navigation example">
        <div class="text-center">
            <input class="input-page" type="text" disabled value='Página atual <?php echo $aDados['paginaAtual'] ?>'>
        </div>
        <ul class="pagination justify-content-center">
            <li class="page-item <?php $aDados['paginaAtual'] <= 1 ? print 'disabled' : print '' ?>">
                <a href="<?php echo '/visualizar/filiados?pagina=1' ?>" class="page-link">Página Inicial</a>
            </li>

            <?php ViewListagemFiliado::renderPagination($aDados['totalPaginas'], $aDados['paginaAtual']); ?>

            <li class="page-item <?php (int)$aDados['paginaAtual'] >= (int)$aDados['totalPaginas'] ? print 'disabled' : print '' ?>">
                <a class="page-link" href="<?php echo '/visualizar/filiados?pagina=' . $aDados['totalPaginas'] ?>">Última
                    Página</a>
            </li>
        </ul>
    </nav>
</section>

