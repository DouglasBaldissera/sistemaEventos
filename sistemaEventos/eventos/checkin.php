<?php

session_start();

$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';
$idEvento = $_GET['i'];
// echo"id_us: ".$idUsuario;
// echo" - id_ev: ".$idEvento;

$url = "http://127.0.0.1:8200/api/inscricaos";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
// $resultado = json_decode(curl_exec($ch));

$resultado = (array) json_decode(curl_exec($ch));
$dadosInscricoes = $resultado['data'];

for ($i=0; $i < sizeof($dadosInscricoes); $i++) {
    if ($dadosInscricoes[$i]->usuario_id == $idUsuario && $dadosInscricoes[$i]->evento_id == $idEvento) {
        $idInscricao = $dadosInscricoes[$i]->id;
    }
}

$url       = 'http://127.0.0.1:8200/api/inscricaos/'.$idInscricao;
$cabecalho = array('Content-Type: application/json', 'Accept: application/json');
$campos    = json_encode(array('status_inscricao' => 2));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,            $url);
curl_setopt($ch, CURLOPT_HTTPHEADER,     $cabecalho);
curl_setopt($ch, CURLOPT_POSTFIELDS,     $campos);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST,           true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');

$resposta = curl_exec($ch);

curl_close($ch);

echo"Check-in realizado com sucesso.";
?>