<?php
require_once 'conect.php';

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'cad_user':
            cad_user();
            break;
        case 'add_to_carrinho':
            addToCarrinho();
            break;
    }
}

function cad_user()
{
    global $connect;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $data = $_POST['data-nasc'];
    $nacionalidade = $_POST['nacionalidade'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $senha = md5($_POST['senha']);
    if (isset($_POST['receber-email'])) {
        $receber = 1;
    } else {
        $receber = 0;
    }

    $sql1 = "INSERT INTO `login_usuario`(`login`, `senha`) VALUES ('$email', '$senha')";
    $connect->query($sql1);

    $fk_login = $connect->insert_id;

    $sql2 = "INSERT INTO `dados_usuario`(`fk_login`, `nome`, `cpf`, `cep`, `telefone`, `email`, `data_nacimento`, `nacionalidade`, `email_marketing`) VALUES ('$fk_login', '$nome', '$cpf', '$cep', '$celular', '$email', '$data', '$nacionalidade', '$receber')";
    if ($connect->query($sql2)) {
        header('Location: ../../index.php');
    } else {
        echo $sql2;
    }
}


function addToCarrinho()
{
    session_start();
    $compra = $_POST['produto'];
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array($compra);
    } else {
        array_push($_SESSION['carrinho'], $compra);
    }
    echo json_encode("Adicionado com sucesso");
}
