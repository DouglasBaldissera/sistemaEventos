<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de eventos</title>
    </head>
    <body>
        <?php
        //**** LISTA OS EVENTOS QUE O USUÁRIO ESTÁ INSCRITO *****/
        session_start();

        $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';

        $url = "http://127.0.0.1:8200/api/inscricaos";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $resultado = (array) json_decode(curl_exec($ch));

        $dados = $resultado['data'];

        $inscricoesUsuario = [];

        // Filtra somente as inscrições do usuário logado
        for ($i=0; $i < sizeof($dados); $i++) {
            if ($id_usuario == $dados[$i]->usuario_id) {
                $inscricoesUsuario[$i] = json_decode(json_encode($dados[$i]), true);
            }
        }

        //VERIFICA SE CERTIFICADO JÁ FOI GERADO
        $url = "http://127.0.0.1:8300/api/certificados";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $resultadoCertificados = (array) json_decode(curl_exec($ch));
    
        $dadosCertificados = $resultadoCertificados['data'];

        if (sizeof($dadosCertificados) == 0) {
            for ($i=0; $i < sizeof($dados); $i++) {
                $inscricoesUsuario[$i]['certificadoGerado'] = 0;
            }
        } else {
            
            for ($j=0; $j < sizeof($dadosCertificados); $j++) {
                $certificadosUsuario[$j] = json_decode(json_encode($dadosCertificados[$j]), true);
            }
            for ($i=0; $i < sizeof($inscricoesUsuario); $i++) {
                $certificadoGerado = false;
                $inscricoesUsuario[$i]['certificadoGerado'] = 0;
                for ($j=0; $j < sizeof($certificadosUsuario); $j++) {
                    if ($inscricoesUsuario[$i]['id'] == $certificadosUsuario[$j]['inscricao_id']) {
                        $certificadoGerado = true;
                        $inscricoesUsuario[$i]['certificadoGerado'] = 1;
                    }
                }
            }
        }

        ?>
    
  <div style="text-align: center; font-size: 20px; margin: 20px 0px"><?php echo "LISTA DE EVENTOS INSCRITOS";?></div>
        <div style="display:flex; justify-content:space-evenly; align-items: center;">
        <form action="inscricaoEvento.php" method="post">
            <?php
                for ($i=0; $i < sizeof($inscricoesUsuario); $i++) {
                    // Coloca status inscrição conforme ids banco
                    if ($inscricoesUsuario[$i]['status_inscricao'] == 0) {
                        $statusInscricao = 'Cancelada';
                    } else if ($inscricoesUsuario[$i]['status_inscricao'] == 1) {
                        $statusInscricao = 'Ativa';
                    } else if ($inscricoesUsuario[$i]['status_inscricao'] == 2) {
                        $statusInscricao = 'Participada';
                    }

                    echo "<b>#</b>" . $inscricoesUsuario[$i]['id'] . "<br>";
                    echo "<b>Evento: </b>" . $inscricoesUsuario[$i]['evento_id'] . "<br>";
                    echo "<b>Status: </b>" . $statusInscricao . "<br>";
                ?>
                <input type="text" name="id_evento" style="opacity: 0; position: absolute; top: -50px;" 
                    value="<?php print_r($inscricoesUsuario[$i]['evento_id']); ?>">
            <?php
                echo "<hr>";
                }
            ?>
        </form>
        
        <form action="checkin.php" method="post" style="display:flex; flex-direction: column;">
            <?php
                for ($i=0; $i < sizeof($inscricoesUsuario); $i++) {
                    if ($inscricoesUsuario[$i]['status_inscricao'] == 1) {
            ?>       
                <a style="margin-top:20px; padding: 10px 20px; text-decoration:none; background-color: #D2D2D2; border-radius: 10px;" href="checkin.php?i=<?php echo $inscricoesUsuario[$i]['evento_id']?>">
                    <?php echo"Check-in";?>
                </a>
            <?php
                } else {
            ?>
                <div style="height: 45px;"></div>
            <?php
                }
                echo "<hr>";
                }
            ?>
        </form>

        <form action="cancelar.php" method="post" style="display:flex; flex-direction: column;">
            <?php
                for ($i=0; $i < sizeof($inscricoesUsuario); $i++) {
                    if ($inscricoesUsuario[$i]['status_inscricao'] == 1) {
                ?>       
                    <a style="margin-top:20px; padding: 10px 20px; text-decoration:none; background-color: #D2D2D2; border-radius: 10px;" href="cancelar.php?i=<?php echo $inscricoesUsuario[$i]['evento_id']?>">
                        <?php echo"Cancelar";?>
                    </a>
                <?php
                    } else {
                ?>
                    <div style="height: 45px;"></div>

                <?php } ?>
                
            <?php
                    echo "<hr>";
                }
            ?>
        </form>
        
        <form action="certificado.php" method="post" style="display:flex; flex-direction: column;">
            <?php
                for ($i=0; $i < sizeof($inscricoesUsuario); $i++) {
                // Se participou do evento pode gerar/imprimir o certificado
                if ($inscricoesUsuario[$i]['status_inscricao'] == 2) {
            ?>
                <a style="margin-top:20px; padding: 10px 20px; text-decoration:none; background-color: #D2D2D2; border-radius: 10px;" href="certificado.php?c=<?php echo $inscricoesUsuario[$i]['certificadoGerado']?>&i=<?php echo $inscricoesUsuario[$i]['id']?>">
  
                <?php 
                    if ($inscricoesUsuario[$i]['certificadoGerado']) {
                        echo"Imprimir certificado ";
                    } else {
                        echo"Gerar certificado ";
                    }
                    ?>
                </a>
            <?php
                } else {
            ?>          
                <div style="height: 45px;"></div>
            <?php
                }
                    echo "<hr>";
                }
            ?>
        </form>

        </div>
    </body>
</html>