<?php
$idInscricao = $_GET['i'];
$certificadoGerado = $_GET['c'];
echo"ID EV: ".$idInscricao;
echo"aa: ".$certificadoGerado;

if ($certificadoGerado == 0) {
    // Código aleatório identificador do certificado
    $codigo = uniqid();

    $iniciar = curl_init("http://127.0.0.1:8300/api/certificados");

    curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

    $dados = array (
        'inscricao_id' => $idInscricao,
        'codigo'=> $codigo,
    );

    curl_setopt($iniciar, CURLOPT_POST, true);

    curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados);

    curl_exec($iniciar);
    curl_close($iniciar);

    echo"Certificado gerado com sucesso.";
} else {
    // PEGAR CÓDIGO DO CERTIFICADO QUE ESTÁ TABELA CERTIFICADO
    $url = "http://127.0.0.1:8300/api/certificados";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    // $resultado = json_decode(curl_exec($ch));

    $resultado = (array) json_decode(curl_exec($ch));

    $dadosCertificados = $resultado['data'];

    for ($i=0; $i < sizeof($dadosCertificados); $i++) {
        if ($idInscricao == $dadosCertificados[$i]->inscricao_id) {
            $codigo = $dadosCertificados[$i]->codigo;
        }
    }
}
header ("location: mostrarCertificado.php?a=".$idInscricao."&c=".$codigo);

// <script type="text/javascript">
//     window.open('url_goes_here', '_blank');
// </script>
?>