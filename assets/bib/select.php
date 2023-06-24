<?php
require_once 'conect.php';

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'login':
            login();
            break;
        case 'tipos_ingresso':
            tipos_ingressos();
            break;
        case 'parques_abertos':
            parques_abertos();
            break;
    }
}

function login()
{
    global $connect;

    $email = $_POST['e-mail'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM login_usuario INNER JOIN dados_usuario ON login_usuario.id = dados_usuario.fk_login WHERE login = '$email' AND senha = '$senha'";
    $return = $connect->query($sql);

    if (mysqli_num_rows($return) === 0) {
        echo "Login inválido, verifique se digitou os campos corretamente e tente novamente.";
        exit;
    } else {
        session_start();
        $resultado = mysqli_fetch_assoc($return);
        $_SESSION['id'] = $resultado['fk_login'];
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['cpf'] = $resultado['cpf'];
        $_SESSION['cep'] = $resultado['cep'];
        $_SESSION['telefone'] = $resultado['telefone'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['data_nacimento'] = $resultado['data_nacimento'];
        $_SESSION['nacionalidade'] = $resultado['nacionalidade'];
        $_SESSION['email_marketing'] = $resultado['email_marketing'];
        header('Location: ../../index.php');
        exit;
    }
}

function tipos_ingressos()
{
    global $connect;

    $parque = $_POST['parque'];
    $sql = "SELECT * FROM ingresso WHERE fk_parque = '$parque'";
    $result = $connect->query($sql);
    $retorno = '<h4>Selecione o ingresso</h4>';
    $identificador = 0;
    while ($resultado = mysqli_fetch_assoc($result)) {
        $identificador++;
        $nome = $resultado['nome'];
        $img = $resultado['img'];
        $idade = $resultado['idade'];
        $descricao = $resultado['descricao'];

        $retorno .= "<div class='row'>
                        <div class='col-12' style='border: solid 2px lightgray; border-radius: 10px; margin-bottom: 20px;'>
                            <div class='row' style='margin-left: 0%!important; width: 100%!important;'>
                                <div class='col-sm-5' style='padding: 0px;'>
                                    <img src='assets/img/$img' alt='' style='width: 100%'>
                                </div>
                                <div class='col-sm-7' style='padding-top: 20px'>
                                    <h6 style='color: #000; font-weight: 600; text-align: center;'>$nome <br><span style='font-size: 12px;'> $idade;</span></h6>
                                    <h6 id='descricao$identificador' style='height: 100px; position: relative; overflow-y: hidden;'>$descricao
                                    <p id='ler_mais$identificador' style='height: 40px; position: absolute; bottom: 0; width: 100%; color: #f68c16; background-color: #fff; margin: 0px;' onclick='ler_mais($identificador)'><br>Ler mais</p>
                                    </h6>
                                    <center>
                                    <button class='button_quantidade'>-</button>
                                        <span class='quantidade' id='quant_senior'>0</span>
                                        <button class='button_quantidade'>+</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div";
    }

    $retorno .= "<div><button type='button' data-bs-target='#carouselExample' data-bs-slide='prev' style='width: 96%; margin: 2%; background-color: #f68c16; color: white; border: none; border-radius: 5px;' onclick='etapas_ingresso(\"selecao_parque\")'> Voltar para a seleção do parque</button></div>";

    echo json_encode($retorno);
}

function num_mes($mes)
{
    switch ($mes) {
        case 'Janeiro':
            $retorno = '01';
            break;
        case 'Fevereiro':
            $retorno = '02';
            break;
        case 'Março':
            $retorno = '03';
            break;
        case 'Abril':
            $retorno = '04';
            break;
        case 'Maio':
            $retorno = '05';
            break;
        case 'Junho':
            $retorno = '06';
            break;
        case 'Julho':
            $retorno = '07';
            break;
        case 'Agosto':
            $retorno = '08';
            break;
        case 'Setembro':
            $retorno = '09';
            break;
        case 'Outubro':
            $retorno = '10';
            break;
        case 'Novembro':
            $retorno = '11';
            break;
        case 'Dezembro':
            $retorno = '12';
            break;
    }
    return $retorno;
}


function parques_abertos()
{
    global $connect;

    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $mes = num_mes($mes);
    $data_escolhida = $ano . '-' . $mes . '-' . $dia;
    $data = date($data_escolhida);
    $diasemana_numero = date('w', strtotime($data)) + 1;
    $sql = "SELECT * FROM parques";
    $result = $connect->query($sql);
    $retorno = '';
    while ($resultado = mysqli_fetch_assoc($result)) {
        $nome = $resultado['nome'];
        $aberto_sempre = $resultado['aberto_sempre'];
        $dia_fechado = $resultado['dias_fechados'];
        $fechado = false;
        if(strpos($dia_fechado, ',')){
            $dias_fechados = explode(',', $dia_fechado);
            for($i = 0; $i < count($dias_fechados); $i++){
                if($diasemana_numero == $dias_fechados[$i]){
                    $fechado = true;
                }
            }
        }else if($dia_fechado == $diasemana_numero){
            $fechado = true;
        }

        if ($nome == 'Water Park') {
            if ($aberto_sempre == 1 || $fechado == false) {
                $retorno .= '<div class="col-6">
                            <label for="parque_wp" class="selecione_parques" id="parque_selecionado3">
                                <img src="assets/img/waterpark.webp" alt="">
                            </label>
                            <input onchange="selecione_parque()" type="radio" value="3" name="parques" id="parque_wp" style="display: none;">
                        </div>';
            }
        }
        if ($nome == 'Kawana Park') {
            if ($aberto_sempre == 1 || $fechado == false) {
                $retorno .= '<div class="col-6">
                <label for="parque_kp" class="selecione_parques" id="parque_selecionado1">
                    <img src="assets/img/kawana.webp" alt="">
                </label>
                <input onchange="selecione_parque()" type="radio" value="1" name="parques" id="parque_kp" style="display: none;">
            </div>';
            }
        }
        if ($nome == 'Clube Privé') {
            if ($aberto_sempre == 1 || $fechado == false) {
                $retorno .= '<div class="col-6">
                            <label for="parque_cp" class="selecione_parques" id="parque_selecionado2">
                                <img src="assets/img/clubePriveAzul.webp" alt="">
                            </label>
                            <input onchange="selecione_parque()" type="radio" value="2" name="parques" id="parque_cp" style="display: none;">
                        </div>';
            }
        }
        if ($nome == 'Náutico Praia Clube') {
            if ($aberto_sempre == 1 || $fechado == false) {
                $retorno .= '<div class="col-6">
                            <label for="parque_np" class="selecione_parques" id="parque_selecionado4">
                                <img src="assets/img/nautico.webp" alt="">
                            </label>
                            <input onchange="selecione_parque()" type="radio" value="4" name="parques" id="parque_np" style="display: none;">
                        </div>';
            }
        }
    }
    echo json_encode($retorno);
}
