<section class="pagina-empresa">
    <div class="container">

        <div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresa" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEmpresa">Atualizar Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="empresa-form" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="dependente-nome" class="col-form-label">Nome</label>
                                <input name="nome" type="text" class="form-control" id="empresa-input">
                                <input type="hidden" name="idEmpresa" id="idEmpresaHidden" >

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="jumbotron bg-light mb-4 mt-4 p-4 text-center">
                    <div class="container">
                        <h1 class="display-4">Painel empresas</h1>
                        <p class="lead">Aqui você pode remover, editar, visualizar e cadastrar novas empresas.</p>
                    </div>
                </div>
                <div class="formulario-cadastro">

                    <form action="/salva/empresa" method="post">
                        <?php
                        if (!empty($aDados['mensagem'])) {
                            ?>
                            <div class="alert alert-<?php echo $aDados['mensagem']['status'] ?> alert-dismissible fade show"
                                 role="alert">
                                <strong><?php echo $aDados['mensagem']['titulo'] ?></strong>
                                <?php echo $aDados['mensagem']['conteudo'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <div class="form-group mb-4">
                            <label for="nomeEmpresa">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nomeEmpresa"
                                   placeholder="Digite o nome da empresa">
                        </div>
                        <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
