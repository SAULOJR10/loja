<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privé Diversão</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
</head>

<body>
    <!-- Menu superior -->
    <?php include_once 'assets/comum/navbar.php' ?>
    <!-- End menu superior -->
    <div class="div-content">
        <div class="div-conteudo">
            <div class="div-titulo">
                <h2>Faça seu login ou<br>cadastre-se</h2>
            </div>
            <div class="div-login">
                <h4>Login</h4>
                <input type="text" class="e-mail" name="e-mail" id="e-mail" placeholder="E-mail">
                <input type="password" class="senha" name="senha" id="senha" placeholder="Senha">
                <br>
                <input type="button" class="button-login" value="Faça seu login" onclick="login()">
                <div class="row">
                    <p class="esq-senha">Esqueceu sua senha?</p>
                    <p class="esq-login">Esqueceu seu login?</p>
                </div>
            </div>
            <div class="div-divisao">
                <h4><span class="linha">__________</span> OU <span class="linha">__________</span></h4>
            </div>
            <div class="div-redes-sociais">
                <button class="button-redes-socias">
                    <img src="assets/img/facebook_icon.svg" style="float: left; width: 25px;">
                    Entrar com Facebook
                </button>
                <button class="button-redes-socias">
                    <img src="assets/img/google_icon.svg" style="float: left; width: 25px;">
                    Entrar com Google
                </button>
                <button class="button-redes-socias">
                    <img src="assets/img/apple_icon.svg" style="float: left; width: 25px;">
                    Entrar com ID Apple
                </button>
            </div>
        </div>
    </div>

    <!-- CADASTRE-SE -->
    <div class="cadastre-se" onclick="window.location.href='cadastro.php'">
        <h2>Criar nova conta</h2>
    </div>


    <div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="ModalLoginLabel" aria-hidden="true">
        <di v class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <h4 style="width: 90%;"><img src="assets/img/logo.webp" alt="" style="width: 80px; margin-left: 10%;"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0px; display: flex; justify-content: center; align-items: center;">
                    <div id="elemento_pai">
                        <h4 id="titulo_aviso"></h4>
                        <div class="row" style="width: 100%; margin: 0 auto;" id="text_aviso">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="width: 98%; margin: 1%; background-color: #0ABBF3; color: white; border: none;" class="btn" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
    </div>
</body>

</html>