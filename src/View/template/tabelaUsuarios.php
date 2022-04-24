<?php
use Micaelandrade\Avaliacao\View\ViewUsuario;


?>
<section class="usarios">

    <div class="container">

        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
                <div class="jumbotron bg-light mb-4 mt-4 p-4">
                    <div class="row">
                        <h1 class="display-6">Lista dos usuários.</h1>
                        <p class="lead">
                            Aqui você pode remover e visualizar usuários.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($aDados['mensagem'])) {
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
                    <th class="text-center" scope="col"><i class="bi bi-info-circle"></i> Ativo</th>
                    <th class="text-center" scope="col"><i class="bi bi-person-bounding-box"></i> Perfil</th>
                    <th class="text-center" scope="col"><i class="bi bi-card-heading"></i> Login</th>
                    <th class="text-center" scope="col"><i class="bi bi-person-x"></i> Remover</th>
                </tr>
                </thead>
                <tbody>
                <?php ViewUsuario::renderTable($aDados['usuarios']); ?>
                </tbody>
            </table>
        </div>

    </div>
</section>
