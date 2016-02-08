<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$id = Request::get("ID");
echo $id;
$usuarios = $gestor->get($id);
//var_dump($gestor->getValuesSelect());

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
       <form action="../usuario/phpedit.php" method="POST" enctype="multipart/form-data">
                           <div class="logo"></div>
                <div class="login-block">
            <input type="hidden" name="email" value="<?php echo $usuarios->getEmail()?>" /><br />
            <input type="file" name="nuevaImagen" value="" /><br />
            <input type="hidden" name="imagen" value="< ?php echo $usuarios->getImagen();?>" /><br />
            <span class="labels">Email<sup>*</sup></span><input type="text" name="email" value="<?php echo $usuarios->getEmail();?>"/><br /></span>
            <input type="hidden" name="clave" value="<?php echo $usuarios->getClave();?>" /><br />
            
            <label for="nombre">Nombre: </label><input type="text" name="nombre" value="<?php echo $usuarios->getNombre();?>"/><br/>
            <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" value="<?php echo $usuarios->getApellidos();?>" /><br/>  
            <label for="pais">Pais: </label><input type="text" name="pais" value="<?php echo $usuarios->getPais();?>" /><br/>
            <label for="ciudad">Ciudad: </label><input type="text" name="ciudad" value="<?php echo $usuarios->getCiudad();?>" /><br/> 

            <span class="labels">Alias<sup>*</sup></span><input type="text" name="alias" value="<?php echo $usuarios->getAlias();?>"/><br />
            <label>Plantillas</label>
            <select name="plantillas">
              <option value="Piccolo">Piccolo</option>
              <option value="Single">Single</option>
              <option value="Travel">Travel</option>
            </select><br/>
            
            <input type="hidden" name="fechaalta" value="<?php echo $usuarios->getFechaalta();?>" /><br />
            <input type="hidden" name="pkID" value="<?php echo $usuarios->getEmail();?>" /><br/>
            <input class="botonEditar" type="submit" value="editar"/>
            <a href="../acceso/indexBaja.php"><button type="button">Atras</button></a>
                </div>
        </form>
    </body>
</html>
<?php
$bd->close();
