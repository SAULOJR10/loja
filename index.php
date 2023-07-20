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

<body>
    <!-- Menu superior -->
    <?php include_once 'assets/comum/navbar.php' ?>
    <!-- End menu superior -->
    
    <div class="div-content div-calender">
        <div class="div-conteudo div-conteudo-calendario">
            <div style="padding: 0px;">
                <section class="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="padding: 0px;" id="calender">
                            </div>
                        </div>
                        <button class="button_ingresso" style="margin-bottom: 20px;background-color: #f68c16;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="etapas_ingresso('selecao_parque')">Comprar ingresso</button>
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
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="width: 98%; margin: 1%; background-color: #0ABBF3; color: white; border: none;" class="btn btn-primary" onclick="etapas_ingresso('tipo_ingresso')" id="button_avancar">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>