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
        case 'exibir_carrinho':
            exibir_carrinho();
            break;
    }
}

function login()
{
    global $connect;

    $email = $_POST['e_mail'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM login_usuario INNER JOIN dados_usuario ON login_usuario.id = dados_usuario.fk_login WHERE login = '$email' AND senha = '$senha'";
    $return = $connect->query($sql);

    if (mysqli_num_rows($return) === 0) {
        echo json_encode("Titulo: Login e senha não correspondem. Text: <h5 style='text-align: center;'>Login inválido, verifique se digitou os campos corretamente e tente novamente.</h5>");
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
        echo json_encode("Sucesso");
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
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $dia_de_hoje = strftime('%d', strtotime('today'));
    $mes_atual = num_mes(strftime('%B', strtotime("today")));
    $ano_atual = strftime('%Y', strtotime('today'));
    if ($mes == 3) {
        $nome_mes = "março";
    } else {
        $nome_mes = strftime('%B', strtotime("$ano-$mes"));
    }
    $mes = num_mes($nome_mes);
    $dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    $proximo_mes = $mes + 1;
    if ($proximo_mes >= 12) {
        $proximo_ano = $ano + 1;
        $proximo_mes = 1;
    } else {
        $proximo_ano = $ano;
    }

    if ($mes_atual == $mes && $ano == $ano_atual) {
        $nao_clica = "style='pointer-events: none;'";
    } else {
        $nao_clica = '';
    }
    $mes_anterior = $mes - 1;
    if ($mes <= 1) {
        $ano_anterior = $ano - 1;
        $mes_anterior = 12;
    } else {
        $ano_anterior = $ano;
    }

    $resultado = "<div class='calendar calendar-first' id='calendar_first'>
                <div class='calendar_header'>
                    <button class='switch-month switch-left' id='button_voltar' $nao_clica onclick='montar_calendario($mes_anterior, $ano_anterior)'>
                    <svg style='transform: rotate(180deg);' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 80 80' style='enable-background:new 0 0 80 80;' xml:space='preserve'>
                    <style type='text/css'>
                        .st0{fill:#DD9D57;}
                        .st1{fill:#E5650E;}
                    </style>
                    <g>
                        <g id='XMLID_00000013190481926466546840000010218336091466452389_'>
                            <path id='XMLID_00000170272149239471086570000011021174623930353312_' class='st0' d='M17.48,19.75c0.6-0.17,1.22-0.27,1.84-0.32    c1.96-0.14,4-0.3,5.52,1.17l13.32,12.83c0.07,0.07,0.13,0.15,0.18,0.23c3.05,5.18,2.22,10.89-1.45,14.56L19.95,65.16    c-0.63,0.63-1.71,0.18-1.71-0.71V54.09c0-0.27,0.11-0.52,0.29-0.71L30.3,41.62c0.51-0.51,0.59-1.11,0.58-1.43    c0-0.31-0.09-0.91-0.61-1.41L13.31,22.45c-0.65-0.62-0.23-1.41,0.69-1.72L17.48,19.75z'/>
                        </g>
                        <g id='XMLID_00000168076439351609785390000016382474320750115474_'>
                            <path id='XMLID_00000176735650774556211470000000843108662465695640_' class='st1' d='M30.91,78.16l-5.18-5.18    c-0.39-0.39-0.39-1.02,0-1.41l30.23-30.23c0.51-0.51,0.59-1.11,0.58-1.43c0-0.31-0.09-0.91-0.61-1.41L25.76,9.43    c-0.4-0.39-0.41-1.03-0.01-1.43l5.18-5.18c0.39-0.39,1.01-0.39,1.4-0.01l30.08,28.97c3.73,3.6,4.68,9.29,1.72,14.53    c-0.05,0.09-0.11,0.17-0.18,0.24L32.32,78.16C31.93,78.55,31.3,78.55,30.91,78.16z'/>
                        </g>
                    </g>
                    </svg>
                    </button>
                    <h2 id='mes'>$nome_mes <span class='text-ano'>$ano</span></h2>
                    <button class='switch-month switch-right' onclick='montar_calendario($proximo_mes, $proximo_ano)'>
                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 80 80' style='enable-background:new 0 0 80 80;' xml:space='preserve'>
                    <style type='text/css'>
                        .st0{fill:#DD9D57;}
                        .st1{fill:#E5650E;}
                    </style>
                    <g>
                        <g id='XMLID_00000013190481926466546840000010218336091466452389_'>
                            <path id='XMLID_00000170272149239471086570000011021174623930353312_' class='st0' d='M17.48,19.75c0.6-0.17,1.22-0.27,1.84-0.32    c1.96-0.14,4-0.3,5.52,1.17l13.32,12.83c0.07,0.07,0.13,0.15,0.18,0.23c3.05,5.18,2.22,10.89-1.45,14.56L19.95,65.16    c-0.63,0.63-1.71,0.18-1.71-0.71V54.09c0-0.27,0.11-0.52,0.29-0.71L30.3,41.62c0.51-0.51,0.59-1.11,0.58-1.43    c0-0.31-0.09-0.91-0.61-1.41L13.31,22.45c-0.65-0.62-0.23-1.41,0.69-1.72L17.48,19.75z'/>
                        </g>
                        <g id='XMLID_00000168076439351609785390000016382474320750115474_'>
                            <path id='XMLID_00000176735650774556211470000000843108662465695640_' class='st1' d='M30.91,78.16l-5.18-5.18    c-0.39-0.39-0.39-1.02,0-1.41l30.23-30.23c0.51-0.51,0.59-1.11,0.58-1.43c0-0.31-0.09-0.91-0.61-1.41L25.76,9.43    c-0.4-0.39-0.41-1.03-0.01-1.43l5.18-5.18c0.39-0.39,1.01-0.39,1.4-0.01l30.08,28.97c3.73,3.6,4.68,9.29,1.72,14.53    c-0.05,0.09-0.11,0.17-0.18,0.24L32.32,78.16C31.93,78.55,31.3,78.55,30.91,78.16z'/>
                        </g>
                    </g>
                    </svg>
                    </button>
                </div>
                <div class='calendar_weekdays'>
                    <div style='color: #fd7e14;'>Dom</div>
                    <div style='color: #000;'>Seg</div>
                    <div style='color: #000;'>Ter</div>
                    <div style='color: #000;'>Qua</div>
                    <div style='color: #000;'>Qui</div>
                    <div style='color: #000;'>Sex</div>
                    <div style='color: #fd7e14;'>Sáb</div>
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
            $resultado .= "<div class='dia blank $fimdesemana'><p style='opacity: 0; margin: 0px; line-height: 100%;'>0<br><span>00,00</b></p></div>";
        }
    }

    for ($i = 1; $i <= $dias_no_mes; $i++) {
        $dia_semana = date('w', strtotime("$i-$mes-$ano"));
        if ($dia_semana == '0' || $dia_semana == '6') { // finais de semana
            $fimdesemana = "fim_de_semana";
        } else {
            $fimdesemana = '';
        }
        $dia_do_mes = $ano . '-' . $mes . '-' . $i;
        $sql1 = "SELECT MIN(valor_promocao) AS valor_promocao FROM promocao WHERE data_inicial <= '$dia_do_mes' AND data_final >= '$dia_do_mes' LIMIT 1";
        $query1 = $connect->query($sql1);
        $result1 = mysqli_fetch_assoc($query1);

        if ($i >= $dia_de_hoje || $mes > $mes_atual || $ano > $ano_atual) { // Dias passados
            if ($i == $dia_de_hoje && $mes == $mes_atual && $ano == $ano_atual) { // teste se é o dia de hoje 
                $resultado .= "<div onclick='selecionar_dia($i)' id='dia$i' class='dia past-date $fimdesemana' style=''>
                                    <p style='margin: 0px; line-height: 100%;'>$i <br><span style='opacity: 0;'>00,00</span></p>
                               </div>";
            } else {
                if ($result1['valor_promocao'] != NULL && $result1['valor_promocao'] != '') { // teste se TEM promocao no dia
                    $valor_promo = $result1['valor_promocao'];
                    $resultado .= "<div onclick='selecionar_dia($i)' id='dia$i' class='dia promocao $fimdesemana'>
                                        <p style='margin: 0px; line-height: 100%;'>$i <br><span style='color: #fff'>$valor_promo</b></p>
                                   </div>";
                } else { // teste se NÃO tem promocao no dia
                    $sql2 = "SELECT MIN(valor) AS valor  FROM ingresso WHERE data_inicial <= '$dia_do_mes' AND data_final >= '$dia_do_mes' LIMIT 1";
                    $query2 = $connect->query($sql2);
                    $result2 = mysqli_fetch_assoc($query2);
                    if ($result2['valor'] == '') {
                        $resultado .= "<div onclick='selecionar_dia($i)' id='dia$i' class='dia $fimdesemana'>
                                        <p style='margin: 0px; line-height: 100%;'>$i <br><span style='opacity: 0;'>0</b></p>
                                   </div>";
                    } else {
                        $valor = $result2['valor'];
                        $resultado .= "<div onclick='selecionar_dia($i)' id='dia$i' class='dia $fimdesemana'>
                                        <p style='margin: 0px; line-height: 100%;'>$i <br><span style='color: #fff'>$valor</span></p>
                                   </div>";
                    }
                }
            }
        } else { // faça se são dias passados
            $resultado .= "<div class='dia past-date $fimdesemana'>
                                <p style='margin: 0px; line-height: 100%;'>$i <br><span style='opacity: 0;'>00,00</b></p>
                            </div>";
        }
    }

    $dias_preencher = date('w', strtotime("$dias_no_mes-$mes-$ano"));
    $quant_dias_restante = 7 - (intval($dias_preencher) + 1);
    for ($i = 1; $i <= $quant_dias_restante; $i++) {
        if ($i == $quant_dias_restante) {
            $fimdesemana = "fim_de_semana";
        } else {
            $fimdesemana = '';
        }
        $resultado .= "<div class='blank $fimdesemana'><p style='opacity: 0; margin: 0px; line-height: 100%;'>0<br><span>00,00</b></p></div>";
    }

    $resultado .= "</div></div>";
    echo json_encode($resultado);
}

function exibir_carrinho()
{
    session_start();
    if ((!isset($_SESSION['carrinho']))) {
        $resposta = "Vazio";
    } else {
        $resposta = "";
        $valor_total = 0;
        foreach ($_SESSION as $key => $valor) {
            if ($key == "carrinho") {
                $ultimo_valor_array = array_key_last($valor);
                $primeiro_valor_array = array_key_first($valor);
                if ($primeiro_valor_array !== null && $ultimo_valor_array !== null) {
                    for ($c = $primeiro_valor_array; $c <= $ultimo_valor_array; $c++) {
                        if ($valor[$c] != NULL) {
                            $quantidade = $valor[$c]['quantidade'];
                            $date = $valor[$c]['data'];
                            $nome = $valor[$c]['nome'];
                            $valor_ingresso =  number_format(floatval($valor[$c]['preco']), 2);
                            $valor_total = $valor_total + $valor_ingresso;
                            $resposta .= "<div id='item$c' class='row div_itens'>
                                        <input type='number' style='display: none;' value='$c' id='item_array$c'>
                                        <div class='col-8' style='text-align: left;'>
                                            <h6 style='color: #000; font-weight: 600;'>
                                                <span>$nome</span>
                                            </h6>
                                            <p style='color: #000; font-weight: 400;'>
                                            Data: $date<br>
                                            Quantidade: $quantidade
                                            </p>
                                            <h6 style='color: #fd7e14; font-weight: 600;'>
                                                <span>Valor unitário: $valor_ingresso</span>
                                            </h6><br>
                                        </div>
                                        <div class='col-4'>
                                        <center>
                                            <button class='button_quantidade' onclick='menos_carrinho($c)'>-</button>
                                                <span class='quantidade' id='quant_ingresso_carrinho$c'>$quantidade</span>
                                                <button class='button_quantidade' onclick='mais_carrinho($c)'>+</button>
                                            </center>
                                        </div>
                                    </div>";
                        }
                    }
                    $valor_total = number_format($valor_total, 2);
                    $resposta .= "<div id='valor_total' class='row valor_total'>
                                        <h6 style='color: #fd7e14; font-weight: 600;'>
                                            <span>Valor Total: $valor_total</span>
                                        </h6><br>
                                  </div>";
                }
            }
        }
    }
    if ($resposta == "") {
        $resposta = "<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center'>Nenhum item adicionado ao seu carrinho!</h5>";
    }
    echo json_encode($resposta);
}
