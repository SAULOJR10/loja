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
                    <select class="Produtos" name="Produtos" id="Produtos" placeholder="Produtos" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Produtos">Produtos</option>
                        <option value="PDV's">PDV's</option>
                        <option value="Cardápio">Cardápio</option>
                        <option value="Vestuário">Vestuário</option>
                        <option value="Lembrancinhas">Lembrancinhas</option>
                        <option value="Cosméticos">Cosméticos</option>
                        <option value="Brinquedos">Brinquedos</option>
                        <option value="Utilitários">Utilitários</option>
                    </select>
                    <select class="Serviços" name="Serviços" id="Serviços" placeholder="Serviços" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Serviços">Serviços</option>
                        <option value="Ingressos">Ingressos</option>
                        <option value="Combos">Combos</option>
                        <option value="Eventos">Eventos</option>
                        <option value="Serviços do parque">Serviços do parque</option>
                        <option value="Serviços de terceirizados">Serviços de terceirizados</option>
                        <option value="Passaporte">Passaporte</option>
                        <option value="Associados">Associados</option>
                    </select>
                    <select class="Ingressos" name="Ingressos" id="Ingressos" placeholder="Ingressos" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Ingressos">Ingressos</option>
                        <option value="Ingressos Digital">Ingressos Digital</option>
                        <option value="Ingresso Físico">Ingresso Físico</option>
                    </select>
                    <select class="Controle" name="Controle" id="Controle" placeholder="Controle" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Controle">Controle</option>
                        <option value="Almoxarifado">Almoxarifado</option>
                        <option value="Gestão de vendas vendidos">Gestão de vendas vendidos</option>
                    </select>
                    <select class="Financeiro" name="Financeiro" id="Financeiro" placeholder="Financeiro" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Financeiro">Financeiro</option>
                        <option value="Laçamento de vendas">Laçamento de vendas</option>
                        <option value="Baixa de vendas">Baixa de vendas</option>
                        <option value="Estorno de vendas">Estorno de vendas</option>
                        <option value="Lançamento de valores (Cartão Consumo)">Lançamento de valores (Cartão Consumo)</option>
                        <option value="Fechamento de caixa">Fechamento de caixa</option>
                    </select>
                    <select class="Relatórios" name="Relatórios" id="Relatórios" placeholder="Relatórios" style="width: 48%; float: left; margin: 0px 1%; margin-bottom: 10px">
                        <option value="Relatórios">Relatórios</option>
                        <option value="Vendas de ingresso">Vendas de ingresso</option>
                        <option value="Vendas de combos">Vendas de combos</option>
                        <option value="Vendas em promoção">Vendas em promoção</option>
                        <option value="Vendas eventos">Vendas eventos</option>
                        <option value="Vendas produtos">Vendas produtos</option>
                        <option value="Cartões de consumo">Cartões de consumo</option>
                    </select>
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