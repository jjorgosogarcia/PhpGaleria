<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorUsuario = new ManageUser($bd);
$sesion = new Session();
$usuario = $sesion->get("email");
$usuarioAdmin = $gestorUsuario->get($usuario);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        
        <form action="../controlUsuario/phpinsert.php" method="POST" enctype="multipart/form-data">
                                       <div class="logo"></div>
                <div class="login-block">
            <span class="labels">Foto: </span><input type="file" name="imagen" value="" /><br />
            <label for="email">Email: </label><input type="email" name="email" value="" /><br/>
            <label for="password">Password: </label><input type="password" name="clave" value="" /><br/>

            <label for="nombre">Nombre: </label><input type="text" name="nombre" value="" /><br/>
            <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" value="" /><br/>  
            <label for="pais">Pais: </label><input type="text" name="pais" value="" /><br/>
            <label for="ciudad">Ciudad: </label><input type="text" name="ciudad" value="" /><br/>  


            <label for="activo">Usuario Activo: </label>
            Si<input type="radio" name="activo" value="1" />
            No<input type="radio" name="activo" value="0" checked="checked" /><br/>

            <?php 
               if ($usuarioAdmin->getAdministrador()==1){
            ?> 
            <label for="administrador">Administrador: </label>
            Si<input type="radio" name="administrador" value="1" />
            No<input type="radio" name="administrador" value="0" checked="checked" /><br/>
            <?php 
                }
            ?> 
            <input type="submit" value="Insertar"/>
                </div>
        </form>
    </body>
</html>
<?php
$bd->close();