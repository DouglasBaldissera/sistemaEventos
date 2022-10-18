<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de eventos</title>
    </head>
    <body>
        <?php
        session_start();

        $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'aaa';
        // print_r($_SESSION['nome_usuario']);
        $url = "http://127.0.0.1:8000/api/eventos";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // $resultado = json_decode(curl_exec($ch));

        $resultado = (array) json_decode(curl_exec($ch));

        $dados = $resultado['data'];
        ?>
        
        <div style="text-align: center; font-size: 20px; margin: 20px 0px"><?php echo "LISTA DE EVENTOS DISPONÍVEIS:";?></div>
        
        <form action="inscricaoEvento.php" method="post">
        
        <?php
            for ($i=0; $i < sizeof($dados); $i++) {
                echo "<b>#</b>" . $dados[$i]->id . "<br>";
                echo "<b>Descrição: </b>" . $dados[$i]->descricao . "<br>";
                echo "<b>Data: </b>" . $dados[$i]->data . "<br>";
        ?>
            
            <a style="background-color: #C3C3C3; border-radius: 10px; padding: 1px 20px;" href="inscricaoEvento.php?i=<?php echo $dados[$i]->id?>">
                <?php echo'Fazer inscrição';?>
            </a>
        <?php
            echo "<hr>";
        }
        ?>
        </form>
    </body>
</html>