<?php

use Micaelandrade\Avaliacao\View\ViewCadastroEmpresa;

?>
<section class="empresa">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="bi bi-person"></i> Nome</th>
                        <th class='text-center' scope="col"><i class="bi bi-pencil-square"></i>Editar</th>
                        <th class='text-center' scope="col"><i class="bi bi-person-x"></i> Remover</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php ViewCadastroEmpresa::renderTableEmpresas($aDados['empresas']); ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>

