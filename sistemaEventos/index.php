<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Sistema de eventos</title>
    </head>
    <body>
        <?php
            $opcoes = [
                0 => [
                    'nome' => 'CADASTRAR USUÁRIO',
                    'rota' => 'cadastrarUsuario.php'
                ],
                1 => [
                    'nome' => 'LOGAR NO SISTEMA',
                    'rota' => 'logar.php'
                ]
            ];
            // foreach ($opcoes as $opcao) {
            //     echo "OP: ".$opcao;
            // }

            /* DENTRO DO onclick="location.href='<?php echo$rota; ?>'"
                <?php echo$rota; ?>
            */

            foreach ($opcoes as $opcao) {
                $rota = $opcao['rota'];
        ?>
            <form action="gateway.php" method="post">
                <input type="text" name="teste" style="opacity: 1; position: absolute; top: -50px;" 
                value="<?php print_r($opcao['nome']); ?>">
                
                <button type="submit" style="font-size: 20px; margin: 20px" >
                    <?php echo '<pre>'; print_r($opcao['nome']); echo '</pre>'; ?>
                </button>
            </form>
        <?php
            }
        ?>
    </body>
</html>