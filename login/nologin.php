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
            <?php if($op="nologin"){ ?>
                    <p>No existe el usuario</p>
            <?php }?>
                <p>En 3 segundos volverá a la página inicial</p>
                 <?php header( "refresh:3; url=phplogout.php" ); ?>
        </div>
    </body>
</html>
