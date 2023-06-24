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
    <div class="menu-top">
        <center><a href="#"><img alt="Logo Privediversão" loading="lazy" class="logo" src="../ecommerce/assets/img/logo-navbar.webp"></a></center>
    </div>
    <!-- End menu superior -->
    <div class="div-content">
        <div class="div-conteudo">
            <div class="div-titulo">
                <h2>Faça seu login ou<br>cadastre-se</h2>
            </div>
            <div class="div-login">
                <form action="assets/bib/select.php" method="post">
                    <h4>Login</h4>
                    <input type="text" name="acao" value="login" style="display: none;">
                    <input type="text" class="e-mail" name="e-mail" id="e-mail" placeholder="E-mail">
                    <input type="text" class="senha" name="senha" id="senha" placeholder="Senha">
                    <br>
                    <input type="submit" class="button-login" value="Faça seu login">
                </form>
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
</body>

</html>