<?php
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['dados_usuario'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include_once 'assets/comum/head.php' ?>

<body id="body">
    <!-- Menu superior -->
    <?php include_once 'assets/comum/navbar.php' ?>
    <!-- End menu superior -->

    <div class="div-content div-calender">
        <div class="div-conteudo div-conteudo-calendario">
            <div style="padding: 0px;">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="padding: 0px;" id="calender">
                            </div>
                        </div>
                        <button class="button_ingresso" style="margin-bottom: 20px;background-color: #f68c16;" onclick="etapas_ingresso('selecao_parque')">Comprar ingresso</button>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <di v class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <h4 style="width: 90%;"><img src="assets/img/logo.webp" alt="" style="width: 80px; margin-left: 10%;"></h4>
                    <button type="button" onclick="fechar_carrinho()" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0px;">
                    <div id="elemento_pai">
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item" id="slide_parques">
                                    <section id="selecao_parque" class="selecao_parque">
                                    <h4>Selecione o Parque</h4>
                                        <div class="row" style="width: 100%; margin: 0 auto;" id="parques_abertos">
                                        </div>
                                    </section>
                                </div>
                                <div class="carousel-item">
                                    <section id="tipo_ingresso" class="tipo_ingresso">
                                        <h4>Adicione seu(s) ingresso(s)</h4>
                                    </section>
                                </div>
                                <div class="carousel-item" id="slide-carrinho">
                                    <section id="carrinho" class="carrousel-carrinho">
                                        <h4>Carrinho</h4>
                                        <div class="row" style="width: 100%; margin: 0 auto;" id="itens_do_carrinho">
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="width: 98%; margin: 1%; background-color: #0ABBF3; color: white; border: none;" class="btn btn-primary" onclick="etapas_ingresso('tipo_ingresso')" id="button_avancar">Continuar</button>
                </div>
            </div>
    </div>

    <div class="modal fade" id="ModalAvisos" tabindex="-1" aria-labelledby="ModalLoginLabel" aria-hidden="true">
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

    <div class="carrinho" onclick="abrirCarrinho(0)">
        <span id="notificacao_carrinho" style="display: none;">0</span>
        <svg width="40px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <style>
                    .cls-1 {
                        fill: #fff;
                    }
                </style>
            </defs>
            <title />
            <g data-name="Layer 61" id="Layer_61">
                <path class="cls-1" d="M10,20a1,1,0,0,1-1-.8L6.66,7.41A3,3,0,0,0,3.72,5H2A1,1,0,0,1,2,3H3.72a5,5,0,0,1,4.9,4L11,18.8A1,1,0,0,1,10.2,20Z" />
                <path class="cls-1" d="M11,27H9.14a4.14,4.14,0,0,1-.38-8.26l18.41-1.67L28.78,9H8A1,1,0,0,1,8,7H30a1,1,0,0,1,.77.37A1,1,0,0,1,31,8.2l-2,10a1,1,0,0,1-.89.8L8.94,20.74A2.13,2.13,0,0,0,9.14,25H11a1,1,0,0,1,0,2Z" />
                <path class="cls-1" d="M26,30a4,4,0,1,1,4-4A4,4,0,0,1,26,30Zm0-6a2,2,0,1,0,2,2A2,2,0,0,0,26,24Z" />
                <path class="cls-1" d="M14,30a4,4,0,1,1,4-4A4,4,0,0,1,14,30Zm0-6a2,2,0,1,0,2,2A2,2,0,0,0,14,24Z" />
                <path class="cls-1" d="M23,27H17a1,1,0,0,1,0-2h6a1,1,0,0,1,0,2Z" />
            </g>
        </svg>
    </div>
</body>

</html>