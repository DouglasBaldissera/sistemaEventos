<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $acao = $_POST['teste'];
        if (empty($acao)) {
            echo "acao is empty";
        } else {
            if ($acao == "LISTAR EVENTOS DISPONÍVEIS") {
                header("Location: eventos/listarEventos.php");
                die();
            } else if ($acao == 'CADASTRAR USUÁRIO') {
                header("Location: usuario/cadastrarUsuario.php");
            } else if ($acao == 'LOGAR NO SISTEMA') {
                header("Location: logar.php");
            } else if ($acao == 'LISTAR EVENTOS CADASTRADOS') {
                header("Location: eventos/listarEventosCadastrados.php");
            } else {
                echo "sem rotaaaaa";
            }
        }
    }
?>