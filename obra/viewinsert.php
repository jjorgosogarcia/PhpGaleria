<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorFactura = new ManageObra($bd);
$sesion = new Session();
$usuario = $sesion->get("email");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        
        <form action="../template/obra/index.php?action=insert&do=cuadro" method="POST" enctype="multipart/form-data">
            <div class="logo"></div>
            <div class="login-block">
                <span class="labels">Fotografia: </span><input type="file" name="imagen" value="" /><br />
                <label for="nombre">Nombre: </label><input type="text" name="nombre" value="" /><br/>
                <label for="descripcion">Descripcion: </label><textarea name="descripcion"></textarea><br/>
                <label for="fecha">Fecha: </label><input type="date" name="fecha" value="" /><br/>
                <input type="submit" value="Insertar"/>
            </div>
        </form>
    </body>
</html>
<?php
$bd->close();