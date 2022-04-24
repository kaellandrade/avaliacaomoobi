<section class="pagina-usuario mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="jumbotron bg-light mb-4 mt-4 p-4 text-center">
                    <div class="container">
                        <h1 class="display-4">Cadastro usuário</h1>
                        <p class="lead">Formulário de cadastro de usuário.</p>
                    </div>
                </div>
                <form action="/salva/usuario" method="post">
                    <?php
                    if (!empty($aDados['mensagem'])) {
                        ?>
                        <div class="alert alert-<?php echo $aDados['mensagem']['status'] ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $aDados['mensagem']['titulo'] ?></strong>
                            <?php echo $aDados['mensagem']['conteudo'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <div class="form-group mb-4">
                        <label for="nome">Nome</label>
                        <input name="nome" type="text" class="form-control" id="nome"
                               placeholder="Digite seu nome">
                    </div>
                    <div class="form-group mb-4">
                        <label for="login">Login</label>
                        <input name="login" type="text" class="form-control" id="login"
                               placeholder="Digite seu login">
                    </div>
                    <div class="form-group mb-4">
                        <label for="senha">Senha</label>
                        <input name="senha" type="password" class="form-control" id="senha"
                               placeholder="Digite sua senha">
                    </div>
                    <div class="form-group mb-4">
                        <label for="senha-confirmacao">Confirme a senha</label>
                        <input name="senha-confirmacao" type="password" class="form-control" id="senha-confirmacao"
                               placeholder="Repita sua senha">
                    </div>
                    <div class="form-group mb-4">
                        <label for="data-nascimento">Data Nascimento</label>
                        <input name="dataNascimento" type="date" class="form-control" id="data-nascimento"
                        >
                    </div>
                    <div class="form-group mb-4">
                        <label for="usuario">Tipo de usuário</label>
                        <select class="form-select" name="usuario-perfil" id="usuario" >
                            <option value="1">Administrador</option>
                            <option selected value="2">Comum</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</section>