<?php
require_once 'conect.php';

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'remove_carrinho':
            remove_carrinho();
            break;
    }
}

function remove_carrinho(){
    $valor_array = $_POST['valor_array'];
    session_start();
    unset($_SESSION['carrinho'][$valor_array]);
    echo json_encode('sucesso');
}

?>