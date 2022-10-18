<?php

session_start();

$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';
$idEvento = $_GET['i'];
// echo"id_us: ".$idUsuario;
// echo"id_ev: ".$idEvento;


$iniciar = curl_init("http://127.0.0.1:8200/api/inscricaos");

curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

$dados = array (
    'usuario_id' => $idUsuario,
    'evento_id'=> $idEvento,
    'status_inscricao' => 1
);

curl_setopt($iniciar, CURLOPT_POST, true);

curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados);

curl_exec($iniciar);
curl_close($iniciar);


// ********** ENVIA E-MAIL *************

require_once('../mail/PHPMailer.php');
require_once('../mail/SMTP.php');
require_once('../mail/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$emailUser = isset($_SESSION['email_user']) ? $_SESSION['email_user'] : 'aaa';
// echo"Usuário_id_logado: ". $id_usuario;


// Debug mailer
$mail = new PHPMailer(true);

try {
    // Debug
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'douglas.baldissera@universo.univates.br';
    // Aqui colocar a senha do e-mail
    $mail->Password = '';
    $mail->Port = 587;

    $mail->setFrom($emailUser);
    $mail->addAddress($emailUser);

    $mail->isHTML(true);
    $mail->Subject = 'Cadastro em sistema de eventos';
    $mail->Body = 'Você se cadastrou em um evento';

    $mail->AltBody = 'Chegou o e-mail do teste ';

} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}


echo"INSCRIÇÃO REALIZADA COM SUCESSO.";
?>