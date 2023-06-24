<?php
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['id'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php");
    exit;
}
?>

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
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/custom.js"></script>
</head>

<body>
    <!-- Menu superior -->
    <div class="menu-top" style="display: flex; align-items: center;">
        <center style="width: 100%; position: relative">
            <a href="#">
                <img alt="Logo Prive Diversão" loading="lazy" class="logo" src="../ecommerce/assets/img/logo-navbar.webp">
            </a>
            <div style="display: flex; align-items: center; height: 60px; top: 0px; right: 0px; z-index: 9999; position: fixed; margin: 0px;">
                <p style="margin: 0px; margin-right: 15px;">
                    <span style="color: #f68c16; font-weight: 700;"><?php echo explode(" ", $_SESSION['nome'])[0] ?></span>
                    <img src="assets/img/user.svg" alt="" width="30px" style="margin-left: 5px;">
                </p>
            </div>
        </center>
    </div>
    <!-- End menu superior -->
    <div class="div-content div-calender">
        <div class="div-conteudo div-conteudo-calendario">
            <!-- <div class="div-titulo">
                <h2 style="font-weight: 600;">Escolha a melhor data para<br>sua <span style="color: #0ABBF3;">VISITA</span></h2>
                <input type="number" style="display: none;" id="mes_atual" value="0">
            </div> -->
            <div style="padding: 0px;">
                <section class="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="padding: 0px;">
                                <div class="calendar calendar-first" id="calendar_first">
                                    <div class="calendar_header">
                                        <button class="switch-month switch-left" id="button_voltar">
                                            <svg fill="#f68c16" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM310.6 345.4c12.5 12.5 12.5 32.75 0 45.25s-32.75 12.5-45.25 0l-112-112C147.1 272.4 144 264.2 144 256s3.125-16.38 9.375-22.62l112-112c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L221.3 256L310.6 345.4z" />
                                            </svg>
                                        </button>
                                        <h2 id="mes"></h2>
                                        <button class="switch-month switch-right">
                                            <svg fill="#f68c16" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="calendar_weekdays"></div>
                                    <div class="calendar_content"></div>
                                </div>
                            </div>
                        </div>
                        <button class="button_ingresso" style="margin-bottom: 20px;background-color: #f68c16;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="parques_abertos()">Comprar ingresso</button>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="text-align: center; color: black; width: 100%; font-weight: 600;">Como será seu dia de diversão?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0px;">
                    <div id="elemento_pai">
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <section id="selecao_parque" class="selecao_parque">
                                        <h4>Selecione o Parque</h4>
                                        <div class="row" style="width: 100%; margin: 0 auto;" id="parques_abertos">
                                        </div>
                                    </section>
                                </div>
                                <div class="carousel-item">
                                    <section id="tipo_ingresso" class="tipo_ingresso">
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <!-- <button type="button" data-bs-target="#carouselExample" data-bs-slide="prev" class="btn btn-secondary" style="width: 48%; margin: 1%; color: white; border: none; background-color: #f68c16;" data-bs-dismiss="modal">Fechar</button> -->
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="width: 98%; margin: 1%; background-color: #0ABBF3; color: white; border: none;" class="btn btn-primary" onclick="etapas_ingresso('tipo_ingresso')">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>