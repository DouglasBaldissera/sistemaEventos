<?php
    session_start();

    $emailUsuario = $_POST['email'];
    $senhaUsuario = $_POST['senha'];
    // echo"EMAIL: ".$emailUsuario;
    // echo"SENHA: ".$senhaUsuario;

    $url = "http://127.0.0.1:8100/api/usuarios";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    $resultado = (array) json_decode(curl_exec($ch));

    $dados = $resultado['data'];
   
    
    for ($i=0; $i < sizeof($dados); $i++) {
        if ($dados[$i]->email == $emailUsuario && $dados[$i]->senha == $senhaUsuario) {
            $_SESSION['id_usuario'] = $dados[$i]->id;
            $_SESSION['email_user'] = $dados[$i]->email;

            $key = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';
            echo"login.php: ". $key;

            header("Location: home.php");
        } else {
            echo'Usuário ou senha incorretos';
        }
    }
    foreach ($resultado['data'] as $evento) {

    }
?>