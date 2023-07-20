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
        case 'montar_calendario':
            montar_calendario();
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
        $id = $resultado['fk_login'];
        $nome = $resultado['nome'];
        $cpf = $resultado['cpf'];
        $cep = $resultado['cep'];
        $telefone = $resultado['telefone'];
        $email = $resultado['email'];
        $data_nacimento = $resultado['data_nacimento'];
        $nacionalidade = $resultado['nacionalidade'];
        $email_marketing = $resultado['email_marketing'];
        $_SESSION['dados_usuario'] = array(
            "id" => "$id",
            "nome" => "$nome",
            "cpf" => "$cpf",
            "cep" => "$cep",
            "telefone" => "$telefone",
            "email" => "$email",
            "data_nacimento" => "$data_nacimento",
            "nacionalidade" => "$nacionalidade",
            "email_marketing" => "$email_marketing",
        );
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
        $valor = $resultado['valor'];

        $retorno .= "<div class='row'>
                        <div class='col-12' style='border-radius: 10px; margin-bottom: 20px;'>
                            <div class='row' style='margin-left: 0%!important; width: 100%!important;'>
                                <div class='col-sm-5' style='padding: 0px;'>
                                    <img src='assets/img/$img' alt='' style='width: 100%'>
                                </div>
                                <div class='col-sm-7' style='padding-top: 20px'>
                                    <h6 style='color: #000; font-weight: 600; text-align: center;'><span id='nome$identificador'>$nome</span> <br><span style='font-size: 12px;'>$idade;</span></h6>
                                    <h6 id='descricao$identificador' style='height: 100px; position: relative; overflow-y: hidden;'>$descricao
                                    <p id='ler_mais$identificador' style='height: 40px; position: absolute; bottom: 0; width: 100%; color: #f68c16; cursor: pointer; background-color: #fff; margin: 0px;' onclick='ler_mais($identificador)'><br>Ler mais</p>
                                    </h6>
                                    <center>
                                    <button class='button_quantidade' onclick='menos($identificador)'>-</button>
                                        <span class='quantidade' id='quant_ingresso$identificador'>0</span>
                                        <button class='button_quantidade' onclick='mais($identificador)'>+</button>
                                    </center>
                                    <h5 style='float: right; color: #f68c16; margin: 0px; margin-top: -20px;'> R$: <span id='valor$identificador'>$valor</span></h5>
                                </div>
                                <button type='button' style='float: right; color: #f68c16; margin-top: -20px; width: 100%; margin: 15px 0px; background-color: #f68c16; color: white; border: none; border-radius: 5px;' onclick='addToCarrinho($identificador)'>Adicionar ao carrinho</button>
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
        case 'janeiro':
            $retorno = '01';
            break;
        case 'fevereiro':
            $retorno = '02';
            break;
        case 'março':
            $retorno = '03';
            break;
        case 'abril':
            $retorno = '04';
            break;
        case 'maio':
            $retorno = '05';
            break;
        case 'junho':
            $retorno = '06';
            break;
        case 'julho':
            $retorno = '07';
            break;
        case 'agosto':
            $retorno = '08';
            break;
        case 'setembro':
            $retorno = '09';
            break;
        case 'outubro':
            $retorno = '10';
            break;
        case 'novembro':
            $retorno = '11';
            break;
        case 'dezembro':
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
        if (strpos($dia_fechado, ',')) {
            $dias_fechados = explode(',', $dia_fechado);
            for ($i = 0; $i < count($dias_fechados); $i++) {
                if ($diasemana_numero == $dias_fechados[$i]) {
                    $fechado = true;
                }
            }
        } else if ($dia_fechado == $diasemana_numero) {
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

function montar_calendario()
{
    global $connect;

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $num_dia = strftime('%d', strtotime('today'));
    $nome_mes = strftime('%B', strtotime('today'));
    $mes = num_mes($nome_mes);
    $ano = strftime('%Y', strtotime('today'));
    $dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

    $resultado = "<div class='calendar calendar-first' id='calendar_first'>
                <div class='calendar_header'>
                    <button class='switch-month switch-left' id='button_voltar' style='pointer-events: none;'>
                        <svg fill='#f68c16' viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'>
                            <path
                                d='M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM310.6 345.4c12.5 12.5 12.5 32.75 0 45.25s-32.75 12.5-45.25 0l-112-112C147.1 272.4 144 264.2 144 256s3.125-16.38 9.375-22.62l112-112c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L221.3 256L310.6 345.4z'>
                            </path>
                        </svg>
                    </button>
                    <h2 id='mes'>$nome_mes $ano</h2>
                    <button class='switch-month switch-right'>
                        <svg fill='#f68c16' viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'>
                            <path
                                d='M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z'>
                            </path>
                        </svg>
                    </button>
                </div>
                <div class='calendar_weekdays'>
                    <div style='color: rgb(68, 68, 68);'>Dom</div>
                    <div style='color: rgb(68, 68, 68);'>Seg</div>
                    <div style='color: rgb(68, 68, 68);'>Ter</div>
                    <div style='color: rgb(68, 68, 68);'>Qua</div>
                    <div style='color: rgb(68, 68, 68);'>Qui</div>
                    <div style='color: rgb(68, 68, 68);'>Sex</div>
                    <div style='color: rgb(68, 68, 68);'>Sáb</div>
                </div>
                <div class='calendar_content'>";
    $dias_preencher = date('w', strtotime("01-$mes-$ano"));
    if ($dias_preencher != '0') { //preencher dias em branco
        for ($i = 0; $i < $dias_preencher; $i++) {
            if ($i == '0' || $i == '6') {
                $fimdesemana = "fim_de_semana";
            } else {
                $fimdesemana = '';
            }
            $resultado .= "<div class='blank $fimdesemana'>0<br>0</div>";
        }
    }

    for ($i = 1; $i <= $dias_no_mes; $i++) {
        $dia_semana = date('w', strtotime("$i-$mes-$ano"));
        if ($dia_semana == '0' || $dia_semana == '6') { // dias que são inais de semana
            $fimdesemana = "fim_de_semana";
        } else {
            $fimdesemana = '';
        }
        $dia_do_mes = $ano . '-' . $mes . '-' . $i;
        $sql1 = "SELECT MIN(valor_promocao) AS valor_promocao FROM promocao WHERE data_inicial <= '$dia_do_mes' AND data_final >= '$dia_do_mes' LIMIT 1";
        $query1 = $connect->query($sql1);
        $result1 = mysqli_fetch_assoc($query1);

        if ($i >= $num_dia) { // teste são dias passado
            if ($i == $num_dia) { // teste se é o dia de hoje
                $resultado .= "<div class='today $fimdesemana' style='color: rgb(0, 189, 170);'>
                                    <p style='margin: 0px;'>$i<br><b style='opacity: 0;'>00,00</b></p>
                               </div>";
            } else {
                if ($result1['valor_promocao'] != NULL) { // teste se TEM promocao no dia
                    $valor_promo = $result1['valor_promocao'];
                    $resultado .= "<div class='promocao $fimdesemana'>
                                        <p style='margin: 0px;'>$i<br><b>$valor_promo</b></p>
                                   </div>";
                } else { // teste se NÃO tem promocao no dia
                    $sql2 = "SELECT MIN(valor) AS valor FROM ingresso WHERE data_inicial <= '$dia_do_mes' AND data_final >= '$dia_do_mes' LIMIT 1";
                    $query2 = $connect->query($sql2);
                    $result2 = mysqli_fetch_assoc($query2);
                    $valor = $result2['valor'];
                    $resultado .= "<div class='$fimdesemana'>
                                        <p style='margin: 0px;'>$i<br><b>$valor</b></p>
                                   </div>";
                }
            }
        } else { // faça se são dias passados
            $resultado .= "<div class='past-date $fimdesemana'>
                                <p style='margin: 0px;'>$i<br><b style='opacity: 0;'>00,00</b></p>
                            </div>";
        }
    }

    $dias_preencher = date('w', strtotime("$dias_no_mes-$mes-$ano"));
    $quant_dias_restante = 7 - (intval($dias_preencher) + 1);
    for ($i = 1; $i <= $quant_dias_restante; $i++) {
        if($i == $quant_dias_restante){
            $fimdesemana = "fim_de_semana";
        }
        $resultado .= "<div class='blank $fimdesemana'>0<br>0</div>";
    }

    $resultado .= "</div></div>";
    echo json_encode($resultado);


    //     $sql = "SELECT MIN(valor) ingressos WHERE DATE($data_atual) <= data_validade) LIMIT 1";
    //     $query = $connect->query($sql);
    //     $result = mysqli_fetch_assoc($query);
    //     $valor = $result['valor'];

    //     $result .= "<div class='calendar_content'>
    //         <div class='blank fim_de_semana'>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>1<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>2<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>3<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>4<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>5<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>6<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>7<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>8<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>9<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>10<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>11<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>12<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>13<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>14<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>15<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date fim_de_semana'>
    //             <p style='margin: 0px;'>16<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>17<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>18<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='past-date '>
    //             <p style='margin: 0px;'>19<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class='today ' style='color: rgb(0, 189, 170);'>
    //             <p style='margin: 0px;'>20<br><b style='opacity: 0;'>00,00</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>21<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class='fim_de_semana'>
    //             <p style='margin: 0px;'>22<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class='fim_de_semana'>
    //             <p style='margin: 0px;'>23<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>24<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>25<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>26<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>27<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>28<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class='fim_de_semana'>
    //             <p style='margin: 0px;'>29<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class='fim_de_semana'>
    //             <p style='margin: 0px;'>30<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class=''>
    //             <p style='margin: 0px;'>31<br><b style='opacity: 1;'>69,99</b></p>
    //         </div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank '>0<br>0</div>
    //         <div class='blank fim_de_semana'>0<br>0</div>
    //     </div>
    // </div>";

    //     echo json_encode($result);
}
