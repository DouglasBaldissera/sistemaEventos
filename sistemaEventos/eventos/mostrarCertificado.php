<?php
    $idInscricao = $_GET['a'];
    $codigoCertificado = $_GET['c'];

    // PEGAR NOME DO USUÁRIO QUE ESTÁ TABELA USUÁRIOS
    session_start();

    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';
    echo"listar_eveto: ". $id_usuario;
    
    $url = "http://127.0.0.1:8100/api/usuarios/".$id_usuario;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $resultado = (array) json_decode(curl_exec($ch));
    $nomeUsuario = $resultado['nome'];
 

    use Dompdf\Dompdf;
    require_once '../dompdf/autoload.inc.php';
    //Instanciar a classe dompdf
    $dompdf = new Dompdf();

    $html = '
    <div style="text-align:center;">
        <h1 > Certificado de participação </h1>
                
        <h2 style="margin-top: 50px;">'.$nomeUsuario.'</h2>

        <p>Participou do evento realizado em 02/12/2021 às 19:00.</p>

        <div style="margin-top: 150px;">
            <p>UNIVATES - Universidade do Vale do Taquari</p>

            <p style="text-align: right; margin-right: 50px;">Código: '.$codigoCertificado.'. 
            Verifique a autenticidade deste certificado
                <a href="http://localhost/sistemaEventos/eventos/verificarCertificado.php?c='.$codigoCertificado.'">clicando aqui</a>
            </p>
        </div>
    </div>';
    $dompdf->loadHtml($html);
    
    //Renderização do HTML
    $dompdf->render();

    //Gerar a saída do documento PDF
    $dompdf->stream(
        "Certificado.pdf", //nome do arquivo
        array(
            "Attachment"=>false
        )
    );
?>