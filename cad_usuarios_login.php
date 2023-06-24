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
        <div class="div-conteudo" style="width: 100%;">
            <div class="div-titulo">
                <h2></h2>
            </div>
            <div class="div-login" style="border-radius: 0px; margin-bottom: 50px">
                <h4 style="margin-bottom: 5px;">Cadastro de Usuário</h4>
                <p>Cadastro de dados de login do usuário dos sistema.<br><br></p>
                <div class="row">
                    <ul style="list-style: none">
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px; background-color: lightgray;">Dados Pessoais</li>
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px;">Permissões</li>
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px;">Dados de login</li>
                    </ul>
                </div>
                <div class="row">
                    <input type="text" class="Usuário" name="Usuário" id="Usuário" placeholder="Usuário" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Senha" name="Senha" id="Senha" placeholder="Senha" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Confirmar Senha" name="Confirmar Senha" id="Confirmar Senha" placeholder="Confirmar Senha" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="E-mail" name="E-mail" id="E-mail" placeholder="E-mail" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                </div>
                <div class="row" style="width: 100%; margin: 40px 0px 20px 0px;">
                    <button class="button-cancelar">Cancelar</button>
                    <button class="button-enviar">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>