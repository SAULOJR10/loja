$(document).ready(function() {
    const date = new Date();
    const currentMonth = date.getMonth() + 1;
    const currentYear = date.getFullYear();
    montar_calendario(currentMonth, currentYear)
});

function montar_calendario(currentMonth, currentYear) {
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/select.php',
        data: {
            acao: 'montar_calendario',
            mes: currentMonth,
            ano: currentYear,
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            $('#calender').empty();
            $('#calender').append(data);
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}

function etapas_ingresso(tipo) {
    if (tipo == 'selecao_parque') {
        parques_abertos();
        $('#button_avancar').empty();
        $('#button_avancar').append('Continuar');
        $('#button_avancar').removeAttr('onclick');
        $('#button_avancar').attr('onclick', 'etapas_ingresso("tipo_ingresso")');
    }
    if (tipo == 'tipo_ingresso') {
        montar_ingressos();
    }
    if (tipo == 'carrinho') {
        addToCarrinho();
    }
}

function montar_ingressos() {
    var parque = document.querySelector('input[name="parques"]:checked').value;
    $('#button_avancar').empty();
    $('#button_avancar').append('Ir para o carrinho');
    $('#button_avancar').removeAttr('onclick');
    $('#button_avancar').attr('onclick', 'etapas_ingresso("carrinho")');

    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/select.php',
        data: {
            acao: 'tipos_ingresso',
            parque: parque,
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            $('#tipo_ingresso').empty();
            $('#tipo_ingresso').append(data);
        },
        error: function(msg) {
            alert(msg.responseText);
        }
    });
}

function parques_abertos() {
    var carousel = document.getElementsByClassName('carousel-item');
    for (var i = 0; i < carousel.length; i++) {
        if (i == 0) {
            carousel[i].classList.add('active');
        } else {
            carousel[i].classList.remove('active');
        }
    }

    var dia = $('.selected').text();
    var mes_ano = $('#mes').text();
    var mes = mes_ano.split(' ')[0];
    var ano = mes_ano.split(' ')[1];
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/select.php',
        data: {
            acao: 'parques_abertos',
            dia: dia,
            mes: mes,
            ano: ano,
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            $('#parques_abertos').empty();
            $('#parques_abertos').append(data);
            $('#exampleModal').on('shown.bs.modal', function() {
                $('#meuInput').trigger('focus')
            })
        },
        error: function(msg) {
            alert('Erro: ' + msg.responseText);
        }
    });
}

function selecione_parque() {
    var check = document.getElementsByName("parques");

    for (var i = 0; i < check.length; i++) {
        if (check[i].checked == true) {
            var valor = check[i].value;
            $('#parque_selecionado' + valor).addClass('parque_selecionado');
        } else if (check[i].checked == false) {
            var valor = check[i].value;
            $('#parque_selecionado' + valor).removeClass('parque_selecionado');
        }
    }
}

function ler_mais(num) {
    $('#descricao' + num).removeAttr('style');
    $('#ler_mais' + num).text('ler menos');
    $('#ler_mais' + num).removeAttr('onclick');
    $('#ler_mais' + num).attr('onclick', 'ler_menos(' + num + ')');
    $('#ler_mais' + num).css('margin-bottom', '40px');
}

function ler_menos(num) {
    $('#descricao' + num).css({ 'height': '100px', 'position': 'relative', 'overflow-y': 'hidden' });
    $('#ler_mais' + num).text('ler mais');
    $('#ler_mais' + num).removeAttr('onclick');
    $('#ler_mais' + num).attr('onclick', 'ler_mais(' + num + ')');
    $('#ler_mais' + num).removeAttr('style');
    $('#ler_mais' + num).css({ 'height': '40px', 'position': 'absolute', 'bottom': '0', 'width': '100%', 'color': '#f68c16', 'cursor': 'pointer', 'background-color': '#fff', 'margin': '0px' });
}

function mais(num) {
    var quant = parseInt($('#quant_ingresso' + num).text());
    quant++;
    $('#quant_ingresso' + num).empty();
    $('#quant_ingresso' + num).append(quant);
}

function menos(num) {
    var quant = parseInt($('#quant_ingresso' + num).text());
    quant--;
    $('#quant_ingresso' + num).empty();
    if (quant >= 0) {
        $('#quant_ingresso' + num).append(quant);
    } else {
        $('#quant_ingresso' + num).append('0');
    }
}

function addToCarrinho(num) {

    if ($('#quant_ingresso' + num).text() != '0') {
        var quantidade = $('#quant_ingresso' + num).text();
        var preco = $('#valor' + num).text();
        var nome = $('#nome' + num).text();
        var parque = document.querySelector('input[name="parques"]:checked').value;
        var dia = date();
        var produto = { 'preço': preco, 'nome': nome, 'quantidade': quantidade, 'parque': parque, 'dia': dia };
    }
    // $.ajax({
    //     method: 'post',
    //     dataType: 'json',
    //     url: 'assets/bib/insert.php',
    //     data: {
    //         acao: 'add_to_carrinho',
    //         produto: produto,
    //         processoData: false,
    //         contentype: false,
    //     },
    //     success: function(data) {

    //     },
    //     error: function(msg) {

    //     }
    // });
}

// CALENDARIO