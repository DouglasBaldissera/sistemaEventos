<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Página inicial</title>
    </head>
    <body>
        <?php
            session_start();

            $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'sem_user';
            $opcoes = [
                0 => [
                    'nome' => 'LISTAR EVENTOS DISPONÍVEIS',
                    'rota' => 'listarEventos.php'
                ],
                1 => [
                    'nome' => 'LISTAR EVENTOS CADASTRADOS',
                    'rota' => 'listarEventosCadastrados.php'
                ],
            ];
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