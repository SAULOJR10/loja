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
                <p>Cadastro de usuários dos sistema.<br><br></p>
                <div class="row">
                    <ul style="list-style: none">
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px; background-color: lightgray;">Dados Pessoais</li>
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px;">Permissões</li>
                        <li style="float: left; box-shadow: 0px 5px 5px 0.5px rgba(0, 0, 0, 0.2); margin-right: 5px; padding: 2px 5px;">Dados de login</li>
                    </ul>
                </div>
                <div class="row">
                    <input type="text" class="Nome completo" name="Nome completo" id="Nome completo" placeholder="Nome completo" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="CPF" name="CPF" id="CPF" placeholder="CPF" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="RG" name="RG" id="RG" placeholder="RG" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Órgão Emissor" name="Órgão Emissor" id="Órgão Emissor" placeholder="Órgão Emissor" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Nacionalidade" name="Nacionalidade" id="Nacionalidade" placeholder="Nacionalidade" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Endereço" name="Endereço" id="Endereço" placeholder="Endereço" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="CEP" name="CEP" id="CEP" placeholder="CEP" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <input type="text" class="Cidade" name="Cidade" id="Cidade" placeholder="Cidade" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <select class="Estado" name="Estado" id="Estado" placeholder="Estado" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="EX">Estrangeiro</option>
                    </select>
                    <input type="text" class="Data de nascimento" name="Data de nascimento" id="Data de nascimento" placeholder="Data de nascimento" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                    <select class="Sexualidade" name="Sexualidade" id="Sexualidade" placeholder="Sexualidade" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Sexo">Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                    <input type="text" class="Telefone" name="Telefone" id="Telefone" placeholder="Telefone" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
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