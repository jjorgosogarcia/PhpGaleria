<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->get("email");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if ($user == null) {
            ?>
            <form name="login" action="phplogin.php" method="POST">
                <div class="logo"></div>
                <div class="login-block">
                    <h1>Login</h1>
                    <input type="text" name="email" value="" placeholder="Email" id="email" />
                    <input type="password" name="password" value="" placeholder="Password" id="password" />
                    <input type="submit" value="Login" name="login"/>
                    <a class="izquierda" href="../usuario/registro.php">Registrarse</a>
                    <a class="derecha" href="../usuario/recuperarPassword.php">Olvide mi contraseña</a>
                </div>
            </form>
            <?php
        } else {
            ?>  
            <a href="phplogout.php">logout</a>
            <?php
        }
        ?>
    </body>
</html>

