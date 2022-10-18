<?php

$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];

$iniciar = curl_init("http://127.0.0.1:8100/api/usuarios");

curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

$dados = array (
    'nome' => $nomeUsuario,
    'email'=> $emailUsuario,
    'senha'=> $senhaUsuario,
);

curl_setopt($iniciar, CURLOPT_POST, true);

curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados);

curl_exec($iniciar);
curl_close($iniciar);



require_once('../mail/PHPMailer.php');
require_once('../mail/SMTP.php');
require_once('../mail/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Debug mailer
$mail = new PHPMailer(true);

try {
    // Debug
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'douglas.baldissera@universo.univates.br';
    // Aqui colocar  a senha do e-mail
    $mail->Password = '';
    $mail->Port = 587;


    $mail->setFrom($emailUsuario);
    $mail->addAddress($emailUsuario);

    $mail->isHTML(true);
    $mail->Subject = 'Cadastro em sistema de eventos';
    $mail->Body = 'Você se cadastrou no sistema de eventos. Acesse com seu e-mail e senha.';

    $mail->AltBody = 'Chegou o e-mail do teste ';

    if ($mail->send()) {
        // echo 'Email enviado com sucesso';
    } else {
        // echo 'Email não enviado';
    }
} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

echo"Cadastro realizado com sucesso.";
// header("Location: /sistemaEventos");
?>