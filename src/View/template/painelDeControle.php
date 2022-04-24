<?php  use Micaelandrade\Avaliacao\Infrastructure\Sistema; ?>

<section class="pagina-painel mt-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 title text-center">Olá <?php echo ucfirst(Sistema::getUsuario()->getSNome())?>, seja bem-vindo!</h1>
                <p class="lead text-justify">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with desktop publishing software like Aldus PageMaker including versions of
                    Lorem Ipsum.
                </p>
            </div>

            <div class="col-md-6">
                <img class="image-boas-vindas img-fluid" src="../../../public/images/bem.png">
            </div>
        </div>
    </div>
</section>