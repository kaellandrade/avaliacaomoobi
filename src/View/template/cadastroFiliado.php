<?php

use Micaelandrade\Avaliacao\View\ViewCadastroCargo;
use Micaelandrade\Avaliacao\View\ViewCadastroEmpresa;
use Micaelandrade\Avaliacao\View\ViewCadastroSituacao;

?>
<section class="pagina-cadastra-filiado mb-5">
    <div class="container">
        <div class="row">
            <div class="jumbotron bg-light mb-4 mt-4 p-4 text-center">
                <div class="container">
                    <h1 class="display-4">Cadastro de filiado</h1>
                    <p class="lead">Cadastre um novo filiado no sitema. Os dependentes podem ser adicionados depois.</p>
                </div>
            </div>

            <form action="/salva/filiado" method="post">
                <?php
                if (!empty($aDados['mensagem'])) {
                    ?>
                    <div class="alert alert-<?php echo $aDados['mensagem']['status'] ?> alert-dismissible fade show"
                         role="alert">
                        <strong><?php echo $aDados['mensagem']['titulo'] ?></strong>
                        <?php echo $aDados['mensagem']['conteudo'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group mb-4">
                            <label for="nome">Nome</label>
                            <input name="nome" type="text" class="form-control nome" id="nome" aria-describedby="emailHelp"
                                   placeholder="Digite o nome do filiado">
                        </div>
                        <div class="form-group mb-4">
                            <label for="cpf">Cpf</label>
                            <input name="cpf" type="text" class="form-control cpf" id="cpf" aria-describedby="emailHelp"
                                   placeholder="Seu CPF">
                        </div>
                        <div class="form-group mb-4">
                            <label for="rg">RG</label>
                            <input name="rg" type="text" class="form-control rg" id="rg" aria-describedby="emailHelp"
                                   placeholder="Digite o rg">
                        </div>
                        <div class="form-group mb-4">
                            <label for="data">Data de nascimento filiado</label>
                            <input name="dataNascimento" type="date" class="form-control" id="data">
                        </div>
                        <div class="form-group mb-4">
                            <label for="empresas">Empresa em que o filiado trabalha</label>
                            <select multiple name="empresa" id="empresas" class="form-control">
                                <?php ViewCadastroEmpresa::renderEmpresas($aDados['empresas']); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="cargos">Cargo</label>
                            <select name="cargo" id="cargo" multiple class="form-control">
                                <?php ViewCadastroCargo::renderCargos($aDados['cargos']); ?>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="situacao">Situação</label>
                            <select multiple name="situacao" id="situacao" class="form-control">
                                <?php ViewCadastroSituacao::renderSituacoes($aDados['situacoes']); ?>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="telefone-residencial">Telefone residencial</label>
                            <input name="tel" type="text" class="form-control telefone" id="telefone-residencial"
                                   aria-describedby="emailHelp"
                                   placeholder="Tel Recidencial">
                        </div>
                        <div class="form-group mb-4">
                            <label for="telefone-celular">Telefone celular</label>
                            <input name="cel" type="text" class="form-control celular" id="telefone-celular"
                                   aria-describedby="emailHelp"
                                   placeholder="Tel Recidencial">
                        </div>
                    </div>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-success">Enviar Filiado</button>
                </div>
            </form>
        </div>

    </div>
</section>
