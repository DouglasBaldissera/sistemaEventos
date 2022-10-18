<?php
    //Iniciando a sessão:
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // session_start();
    }
    $_SESSION['id_usuario'] = '0';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de usuário</title>
    </head>
    <body>
        <?php
        ?>
            <form action="login.php" method="post" style="width: 100%;">
                <div style="margin: 20px 200px; width: 100%;">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div style="margin: 20px 200px; width: 100%;">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                
                <button type="submit" style="font-size: 20px; margin: 20px 200px;" >
                    Logar
                </button>
            </form>
        <?php ?>
    </body>
</html>
