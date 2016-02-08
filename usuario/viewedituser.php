<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$id = Request::get("ID");
$usuarios = $gestor->get($id);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
       <form action="../controlUsuario/phpedit.php" method="POST">
                           <div class="logo"></div>
                <div class="login-block">
            <input type="hidden" name="email" value="<?php echo $usuarios->getEmail()?>" /><br />
            <span class="labels">Email<sup>*</sup></span><input type="text" name="email" value="<?php echo $usuarios->getEmail();?>"/><br />
            <span class="labels">Clave<sup>*</sup> </span><input required  type="text" name="clave" value="<?php echo $usuarios->getClave();?>" /><br />
            <span class="labels">Alias<sup>*</sup></span><input type="text" name="alias" value="<?php echo $usuarios->getAlias();?>"/><br />
            <input type="hidden" name="fechaalta" value="<?php echo $usuarios->getFechaalta();?>" /><br />
            <input type="hidden" name="pkID" value="<?php echo $usuarios->getEmail();?>" /><br/>
            <input class="botonEditar" type="submit" value="editar"/>
            <a href="../acceso/indexBaja.php"><button type="button">Inicio</button></a>
                </div>
        </form>
    </body>
</html>
<?php
$bd->close();
