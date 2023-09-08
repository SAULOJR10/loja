$(document).ready(function() {
    const date = new Date();
    const currentMonth = date.getMonth() + 1;
    const currentYear = date.getFullYear();
    montar_calendario(currentMonth, currentYear);
    var session_carrinho = '<%= Session["carrinho"] %>'
    if (typeof(session_carrinho) != "undefined" && session_carrinho !== null) {
        abrirCarrinho(1);
    }
    if (!$("#itens_do_carrinho").text() == "<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center;'>Nenhum item adicionado ao carrinho.</h5></div>") {
        $(".carrinho").css("opacity", "1");
        $(".carrinho").addClass("shake-vertical");
        var quant_div = document.getElementsByClassName('div_itens');
        var quant_itens = quant_div.length;
        $('#notificacao_carrinho').empty();
        $('#notificacao_carrinho').append(quant_itens);
        $('#notificacao_carrinho').css('display', 'block');
    }
});

function login() {
    var e_mail = document.getElementById('e-mail').value;
    var senha = document.getElementById('senha').value;
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/select.php',
        data: {
            acao: 'login',
            e_mail: e_mail,
            senha: senha,
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            if (data != "Sucesso") {
                var titulo = data.split('Titulo:')[1];
                var titulo = titulo.split("Text:")[0];
                $('#titulo_aviso').empty();
                $('#titulo_aviso').append(titulo);
                var text = data.split('Text:')[1];
                $('#text_aviso').empty();
                $('#text_aviso').append(text);
                var myModal = new bootstrap.Modal(document.getElementById('ModalLogin'));
                myModal.show();
            } else {
                window.location.href = 'index.php';
            }
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}

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

function selecionar_dia(num) {
    for (var i = 0; i <= 31; i++) {
        if (num == i) {
            $('#dia' + num).addClass('selecionado');
        } else {
            $('#dia' + i).removeClass('selecionado');
        }
    }
}

function etapas_ingresso(tipo) {
    if (tipo == 'selecao_parque') {
        var dia_selecionado = document.getElementsByClassName('dia');
        var teste = false;
        for (val of dia_selecionado) {
            if ($(dia_selecionado).hasClass("selecionado")) {
                teste = true;
            }
        }
        if (teste == true) {
            parques_abertos();
            $('#button_avancar').empty();
            $('#button_avancar').append('Continuar');
            $('#button_avancar').removeAttr('onclick');
            $('#button_avancar').attr('onclick', 'etapas_ingresso("tipo_ingresso")');
            var itensCarrousel = document.getElementsByClassName('carousel-item');
            for (val of itensCarrousel) {
                $(itensCarrousel).removeClass('active');
            }
            $("#slide_parques").addClass('active');
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        } else {
            $('#titulo_aviso').empty();
            $('#titulo_aviso').append('Selecione um dia');
            $('#text_aviso').empty();
            $('#text_aviso').append('<h5 style="text-align: center;">Você precisa selecionar o dia que quer visitar nossos parques para continuar comprando.</h5>');
            var myModal = new bootstrap.Modal(document.getElementById('ModalAvisos'));
            myModal.show();
        }
    }
    if (tipo == 'tipo_ingresso') {
        $("#button_avancar").css({ 'pointer-events': 'none', 'opacity': '0.5' });
        montar_ingressos();
    }
    if (tipo == 'carrinho') {
        addToCarrinho();
    }
}

function abrirCarrinho(num) {
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/select.php',
        data: {
            acao: 'exibir_carrinho',
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            if (data == "Vazio") {
                $('#carrinho').css({ 'display': 'flex', 'flex-direction': 'column', 'justify-content': 'center', 'align-items': 'center' });
                $("#itens_do_carrinho").empty();
                $("#itens_do_carrinho").append("<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center;'>Nenhum item adicionado ao carrinho.</h5></div>");
            } else {
                $("#itens_do_carrinho").removeAttr('style');
                $("#itens_do_carrinho").empty();
                $("#itens_do_carrinho").append(data);
            }
        },
        error: function(msg) {
            if (msg.responseText == "Vazio") {
                $('#carrinho').css({ 'display': 'flex', 'flex-direction': 'column', 'justify-content': 'center', 'align-items': 'center' });
                $("#itens_do_carrinho").empty();
                $("#itens_do_carrinho").append("<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center;'>Nenhum item adicionado ao carrinho.</h5></div>");
            } else {
                $("#itens_do_carrinho").removeAttr('style');
                $("#itens_do_carrinho").empty();
                $("#itens_do_carrinho").append(msg.responseText);
            }
        }
    });
    if (num == 0 && typeof(session_carrinho) != "undefined" && session_carrinho !== null) {
        var itensCarrousel = document.getElementsByClassName('carousel-item');
        for (val of itensCarrousel) {
            $(itensCarrousel).removeClass('active');
        }
        $("#slide-carrinho").addClass('active');
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.hide();
        myModal.show();
    } else if (num == 0) {
        var itensCarrousel = document.getElementsByClassName('carousel-item');
        for (val of itensCarrousel) {
            $(itensCarrousel).removeClass('active');
        }
        $("#slide-carrinho").addClass('active');
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.hide();
        myModal.show();
    }
}

function fechar_carrinho() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.hide();
    $('#exampleModal').css('display', 'none');
    $('.modal-backdrop').removeClass('show');
    $('.modal-backdrop').css('display', 'none');
    $('#body').css('overflow', 'auto');
}

function montar_ingressos() {
    var parque = document.querySelector('input[name="parques"]:checked').value;
    $('#button_avancar').empty();
    $('#button_avancar').append('Ir para o carrinho');
    $('#button_avancar').removeAttr('onclick');
    $('#button_avancar').attr('onclick', 'abrirCarrinho()');

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

    var dia = $('.selecionado').text();
    dia = dia.split(' ')[40];
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
            $("#button_avancar").css({ 'pointer-events': 'none', 'opacity': '0.5' });
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
            $('#button_avancar').css({ 'pointer-events': 'auto', 'opacity': '1' })
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

function mais_carrinho(num) {
    var quant = parseInt($('#quant_ingresso_carrinho' + num).text());
    quant++;
    $('#quant_ingresso_carrinho' + num).empty();
    $('#quant_ingresso_carrinho' + num).append(quant);
}

function menos_carrinho(num) {
    var quant = parseInt($('#quant_ingresso_carrinho' + num).text());
    quant--;
    $('#quant_ingresso_carrinho' + num).empty();
    if (quant >= 1) {
        $('#quant_ingresso_carrinho' + num).append(quant);
    } else {
        var valor_array = $('#item_array' + num).val();
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: 'assets/bib/delete.php',
            data: {
                acao: 'remove_carrinho',
                valor_array: valor_array,
                processoData: false,
                contentype: false,
            },
            success: function(data) {
                $('#item' + num).remove();
                if ($('#itens_do_carrinho').text() == "") {
                    $('#carrinho').css({ 'display': 'flex', 'flex-direction': 'column', 'justify-content': 'center', 'align-items': 'center' });
                    $("#itens_do_carrinho").empty();
                    $("#itens_do_carrinho").append("<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center;'>Nenhum item adicionado ao carrinho.</h5></div>");
                    $('#notificacao_carrinho').empty();
                    $('#notificacao_carrinho').append(0);
                    $(".carrinho").css("opacity", "0");
                    $(".carrinho").removeClass("shake-vertical");
                }
            },
            error: function(msg) {
                $('#item' + num).remove();
                if ($('#itens_do_carrinho').text() == "") {
                    $('#carrinho').css({ 'display': 'flex', 'flex-direction': 'column', 'justify-content': 'center', 'align-items': 'center' });
                    $("#itens_do_carrinho").empty();
                    $("#itens_do_carrinho").append("<div style='display: flex; justify-content: center; align-items: center;'><h5 style='text-align: center;'>Nenhum item adicionado ao carrinho.</h5></div>");
                    $('#notificacao_carrinho').empty();
                    $('#notificacao_carrinho').append(0);
                    $(".carrinho").css("opacity", "0");
                    $(".carrinho").removeClass("shake-vertical");
                }
            }
        });
    }
}

function num_mes($mes) {
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

function addToCarrinho(num) {
    if ($('#quant_ingresso' + num).text() != '0') {
        var quantidade = $('#quant_ingresso' + num).text();
        var preco = $('#valor' + num).text();
        var nome = $('#nome' + num).text();
        var parque = document.querySelector('input[name="parques"]:checked').value;
        var dia = $('.selecionado').text();
        dia = dia.split(' ')[40];
        var mes_ano = $('#mes').text();
        var mes = mes_ano.split(' ')[0];
        mes = num_mes(mes);
        var ano = mes_ano.split(' ')[1];
        var data = dia + "/" + mes + "/" + ano;
        var produto = { 'preco': preco, 'nome': nome, 'quantidade': quantidade, 'parque': parque, 'data': data };

        $("#button_avancar").css({ 'pointer-events': 'auto', 'opacity': '1' });
        var quant_notificacao = parseInt($('#notificacao_carrinho').text());
        quant_notificacao++
        $('#notificacao_carrinho').empty();
        $('#notificacao_carrinho').append(quant_notificacao);
        $('#notificacao_carrinho').css('display', 'block');
        $(".carrinho").removeClass("shake-vertical");
        $("#quant_ingresso" + num).empty();
        $("#quant_ingresso" + num).append('0');
    }
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'assets/bib/insert.php',
        data: {
            acao: 'add_to_carrinho',
            produto: produto,
            processoData: false,
            contentype: false,
        },
        success: function(data) {
            $(".carrinho").css("opacity", "1");
            $(".carrinho").addClass("shake-vertical");
        },
        error: function(msg) {
            $(".carrinho").css("opacity", "1");
            $(".carrinho").addClass("shake-vertical");
        }
    });
}

// CALENDARIO