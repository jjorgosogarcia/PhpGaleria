<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageObra($bd);
$id = Request::get("ID");
$usuario = Request::get("usuario");
$obras = $gestor->get($id);
//var_dump($gestor->getValuesSelect());
echo 'el id es: '.$usuario;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <form action="../template/obra/index.php?action=edit&do=cuadro" method="POST" enctype="multipart/form-data">
        <div class="logo"></div>
        <div class="login-block">
            <input type="hidden" name="email" value="<?php echo $usuario?>" />
            <input type="hidden" name="id_cuadro" value="<?php echo $obras->getId_cuadro();?>" />
            <span class="labels">Fotografia: </span><input type="file" name="nuevaImagen" value="" /><br />
            <input type="hidden" name="imagen" value="<?php echo $obras->getImagen();?>" />
            <label for="nombre">Nombre: </label><input type="text" name="nombre" value="<?php echo $obras->getNombre();?>" /><br/>
            <label for="descripcion">Descripcion: </label><textarea name="descripcion"><?php echo $obras->getDescripcion();?></textarea><br/>
            <label for="fecha">Fecha: </label><input type="date" name="fecha" value="<?php echo $obras->getFecha();?>" /><br/>
            <input type="hidden" name="pkID" value="<?php echo $obras->getId_cuadro();?>" /><br/>
            <input type="submit" value="edicion"/>
        </div>
        </form>
    </body>
</html>
<?php
$bd->close();