<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorUsuario = new ManageUser($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <form action="../controlUsuario/phpregister.php" method="POST" >
            <div class="logo"></div>
            <div class="login-block">
             <h1>Registro</h1>
            <label for="email">Email: </label><input type="email" name="email" value="" /><br/>
            <label for="password">Password: </label><input type="password" name="clave" value="" /><br/>   
            <label for="nombre">Nombre: </label><input type="text" name="nombre" value="" /><br/>
            <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" value="" /><br/>  
            <label for="pais">Pais: </label><input type="text" name="pais" value="" /><br/>
            <label for="ciudad">Ciudad: </label><input type="text" name="ciudad" value="" /><br/>  
            <input type="submit" value="Registrar"/>
            <a href="../login/login.php"><button type="button">Atras</button></a>
            </div>
        </form>
    </body>
</html>
<?php
$bd->close();