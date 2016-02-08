<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$id = $sesion->get("email");
echo $id;
$bd = new DataBase();
$gestor = new ManageRelations($bd);
$id2 = Request::get('ID');
$cuadroAutor = $gestor->getCuadroAutor("cu.id_usuario = "."'$id2'");

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
                <?php foreach ($cuadroAutor as $indice => $ca){ ?>
                    <img class="cuadros" src="cuadros/<?= $ca["cuadro"]->getId_usuario()?>/<?= $ca["cuadro"]->getImagen() ?>" />
                    <p><?= $ca["autor"]->getNombre() ?></p>
                    <p><?= $ca["cuadro"]->getDescripcion() ?></p>
                    <!--<a class='borrar' href='../obra/phpdelete.php?Code=< ?= $ca["cuadro"]->getId_cuadro() ?>'>borrar</a>--> 
                    <a class='borrar' href='../temas/Piccolo/index.php?action=delete&do=set'>borrar</a>
                    <a href='../obra/viewedit.php?ID=<?= $ca["cuadro"]->getId_cuadro() ?>&usuario=<?= $id2 ?>'>editar</a>
                    <?php } ?>
            </div>
        </div>
    </body>
</html>
<?php
$bd->close();


