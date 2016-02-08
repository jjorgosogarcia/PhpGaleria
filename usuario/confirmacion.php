<?php
require '../clases/AutoCarga.php';
$op = Request::get("op");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <div class="logo"></div>
        <div  class="login-block">
            <?php if($op=="mail"){?> 
                <p>Se ha enviado un correo de confirmación a su dirección de email</p>
            <?php }else if($op="activado"){ ?>
                <p>Se han registrado los cambios</p>
            <?php } ?>
                <p>En 5 segundos volverá a la página inicial</p>
                 <?php header( "refresh:5; url=../login/login.php" ); ?>
        </div>
    </body>
</html>
