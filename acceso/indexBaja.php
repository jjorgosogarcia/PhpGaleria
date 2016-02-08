<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$id = $sesion->get("email");
$usuarios = $gestor->get($id);
//echo $usuarios->getEmail();
//var_dump($usuarios);

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
        <div  class="login-block2">
        <?php 
                if ($usuarios->getActivo()==0){
            ?> 
        <h2>Lo sentimos pero no ha activado la cuenta</h2>
        <?php }if($usuarios->getActivo()==1){ ?>
    
                <h3>Perfil: <?= $usuarios->getEmail()?></h3>
                <?php if($usuarios->getImagen()=='NULL'){?>
                <img class="avatar" src="../controlUsuario/avatares/noimage.jpg"></img>
                <?php }else{?>
                <img class="avatar" src="../controlUsuario/avatares/<?= $usuarios->getImagen() ?>"></img>
                <?php } ?>
                <span>Nombre: <?= $usuarios->getNombre() ?></span><br>
                <span>Apellidos: <?= $usuarios->getApellidos() ?></span><br>
                <span>Pais: <?= $usuarios->getPais() ?></span><br>
                <span>Ciudad: <?= $usuarios->getCiudad() ?></span><br>
                <span>Alias: <?= $usuarios->getAlias() ?></span><br>
                <div class="separador"></div>
                <a class="enlace" href="../usuario/editar.php?ID=<?= $usuarios->getEmail() ?>">Editar Perfil</a>
                <!--<a class="enlace" href="../usuario/baja.php?ID=< ?= $usuarios->getEmail() ?>">Dar de baja</a>-->
                <a class="enlace" href="../temas/Single/index.php?action=delete&do=me">Dar de baja</a>

                
                <a class="enlace" href="../obra/viewinsert.php?ID=<?= $usuarios->getEmail() ?>">Obras</a>
                <!--<a class="enlace" href="../controlUsuario/viewPhotos.php?ID=< ?= $usuarios->getEmail() ?>">Ver Obras</a>-->
                <a class="enlace" href="../template/obra/index.php?ID=<?= $usuarios->getEmail() ?>">Ver Obras</a>
                <a class="enlace" href="../login/phplogout.php">Logout</a>
                </div>
    </body>
</html>
<?php
$bd->close();
   
 } ?>
