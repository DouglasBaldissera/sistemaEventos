<?php
    $codigo = $_GET['c'];
    $url = "http://127.0.0.1:8300/api/certificados";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $resultado = (array) json_decode(curl_exec($ch));

    $dados = $resultado['data'];

    $certificadoValido = false;
    for ($i=0; $i < sizeof($dados); $i++) {
        if ($dados[$i]->codigo == $codigo) {
            $certificadoValido = true;
        }
    }
    if ($certificadoValido) {
        echo"Certificado validado com sucesso!";
    } else {
        echo"Código incorreto. Não foi possível validar o seu certificado de participação.";
    }
?>