<?php
    require '../clases/AutoCarga.php';
    $bd = new DataBase();
    $gestor = new ManageUser($bd);
    $correo = Request::get("correo");
    $usuarios = $gestor->get($correo);
    $confirm = Request::get("activacion")
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <form action="../controlUsuario/phpnewPassword.php" method="POST" >
            <div class="logo"></div>
            <div class="login-block">
            <h1>Nueva clave</h1>
            <input type="hidden" name="email" value="<?php echo $usuarios->getEmail()?>" /><br />
            <input type="hidden" name="activacion" value="<?php echo $confirm ?>" /><br />
            <label for="password">Password: </label><input type="password" name="clave" value="" /><br/>           
            <input type="submit" value="Enviar"/>
            <a href="../acceso/indexBaja.php"><button type="button">Inicio</button></a>
            </div>
        </form>
    </body>
</html>
