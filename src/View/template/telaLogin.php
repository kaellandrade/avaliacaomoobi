<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Rubik+Moonrocks&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/styles/index.php.css">

    <title>Faça seu login!</title>
</head>
<body>
<section class="pagina-curriculo">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center pagina-login">
            <div class="col-md-6 col-lg-4">
                <?php
                if (!empty($aDados['mensagem'])) {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?php echo $aDados['mensagem']['titulo'] ?></strong>
                        <?php echo $aDados['mensagem']['conteudo'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="caixa-dados-pessoais">
                    <form class="form form-dados-pessoais" method="POST" action="/realiza/login">
                        <i class="bi bi-fingerprint"></i>
                        <h1 class="titulo-dados-pessoais-form">Entrar</h1>
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <i class="input-group-text bi bi-person"></i>
                                <input placeholder="Login" type="text" class="form-control"
                                       id="emailId" aria-describedby="emailHelp" name="login">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <i class="input-group-text  bi bi-key"></i>
                                <input placeholder="Senha" type="password" class="form-control"
                                       id="cpfId" name="senha">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-avancar">
                            Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
