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
            <div class="div-login cadastro">
                <h4>Criar conta</h4>
                <div class="row">
                    <form action="assets/bib/insert.php" method="post">
                        <div class="col-md-12">
                            <input type="text" name="acao" value="cad_user" style="display: none;">
                            <input type="text" class="nome" name="nome" id="nome" placeholder="Nome Completo">
                            <input type="text" class="e-mail" name="email" id="email" placeholder="E-mail">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="celular" name="celular" id="celular" placeholder="Celular">
                        </div>
                        <div class="col-md-6 direito">
                            <input type="text" class="data-nasc" name="data-nasc" id="data-nasc" placeholder="Data de Nascimento">
                        </div>
                        <div class="col-md-6">
                            <select name="nacionalidade" id="nacionalidade">
                                <option value="nacionalidade">Nacionalidade <img src="assets/img/nacionalidade.svg" alt="" srcset="" style="float: right;"></option>
                                <option value="brasileira">Brasileira</option>
                                <option value="estrangeira">Estrangeira</option>
                            </select>
                        </div>
                        <div class="col-md-6 direito">
                            <input type="text" class="cpf" name="cpf" id="cpf" placeholder="CPF">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="cep" name="cep" id="cep" placeholder="CEP">
                        </div>
                        <div class="col-md-6 direito">
                            <input type="text" class="senha" name="senha" id="senha" placeholder="Senha">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="confirm-senha" name="confirm-senha" id="confirm-senha" placeholder="Confirmar a Senha">
                        </div>
                        <div class="col-md-6 direito" style="text-align: left;">
                            <label>
                                <input type="checkbox" class="input-checkbox" name="mostrar-senha" id="mostrar-senha">
                                <div class="checkbox-cad"></div>
                                Mostrar senha
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" class="input-checkbox" name="receber-email" id="receber-email">
                                <div class="checkbox-cad"></div>
                                Receber e-mails promocionais
                            </label>
                        </div>
                </div>
                <input type="submit" class="button-login" style="background-color: #f68c16; margin-top: 30px;">Criar nova conta</button>
                </form>
            </div>
        </div>
    </div>

    <!-- CADASTRE-SE -->
    <div class="cadastre-se" onclick="window.location.href='login.php'" style="background-color: #01afbd;">
        <h2>Login</h2>
    </div>
</body>

</html>