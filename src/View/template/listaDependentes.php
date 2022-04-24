<?php

use Micaelandrade\Avaliacao\View\ViewDependente;

?>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 text-center">
            <div class="jumbotron bg-light mb-4 mt-4 p-4">
                <div class="row">
                    <h1 class="display-6">Lista dos dependentes.</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th  scope="col"><i class="bi bi-person"></i> Nome</th>
                    <th class="text-center" scope="col"><i class="bi bi-person"></i> Grau</th>
                    <th class="text-center" scope="col"><i class="bi bi-person-x"></i> Remover</th>
                    <?php ViewDependente::renderTable($aDados['dependentes']) ?>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>
