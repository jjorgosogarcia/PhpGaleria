<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();
$op = Request::get("op");
$r = Request::get("r");


$page = Request::get("page");
if($page===null || $page ===""){
    $page = 1;
}
/*Nos devuelve el numero de paginas*/
$registros = $gestor->count();
$pages = ceil($registros/  Constant::NRPP);
/**/

$order = Request::get("order");
$sort = Request::get("sort");
$orden = "$order $sort";
$trozoEnlace ="";
if(trim($orden)!=""){
    $trozoEnlace = "&order=$order&sort=$sort";
}
$usuarios = $gestor->getList($page, trim($orden));



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <div class="contenedor"> 
        <h2><?php
            if ($op != null) {
                echo "<h1>El usuario se ha $op </h1>";
            }
            ?>
        </h2>
        <h2><a href="viewinsertadmin.php">Insertar Usuario</a></h2>
        <div class="CSSTableGenerator" >
            <table border="1">
                <thead>
                    <tr class="CSSTableGenerator2">
                        <th>
                            Email 
                            <a href="?order=email&sort=desc">&Del;</a> 
                            <a href="?order=email&sort=asc">&Delta;</a></th>
                        </th>>
                        <th>
                            Nombre
                             <a href="?order=nombre&sort=desc">&Del;</a> 
                            <a href="?order=nombre&sort=asc">&Delta;</a></th>
                        </th>
                        
                        <th>
                            Pais
                             <a href="?order=pais&sort=desc">&Del;</a> 
                            <a href="?order=pais&sort=asc">&Delta;</a></th>
                        </th>
                        
                        <th>
                            Ciudad
                             <a href="?order=ciudad&sort=desc">&Del;</a> 
                            <a href="?order=ciudad&sort=asc">&Delta;</a></th>
                        </th>
                        
                        <th>
                            Alias
                             <a href="?order=alias&sort=desc">&Del;</a> 
                            <a href="?order=alias&sort=asc">&Delta;</a></th>
                        </th>
                        <th>
                            Fecha de alta  
                             <a href="?order=fechaalta&sort=desc">&Del;</a> 
                            <a href="?order=fechaalta&sort=asc">&Delta;</a></th>
                        </th>
                        <th>
                            Activo
                             <a href="?order=activo&sort=desc">&Del;</a> 
                            <a href="?order=activo&sort=asc">&Delta;</a></th>
                        </th>
                        <th>
                            Administrador
                             <a href="?order=administrador&sort=desc">&Del;</a> 
                            <a href="?order=administrador&sort=asc">&Delta;</a></th>
                        </th>

                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="CSSTableGenerator2">
                        <td colspan="11">
                            <a href="?page=1<?php $trozoEnlace ?>">Primero</a>
                            <a href="?page=<?php echo max(1, $page - 1) . $trozoEnlace ?>">Anterior</a>
                            <a href="?page=<?php echo min($page + 1, $pages) . $trozoEnlace ?>">Siguiente</a>
                            <a href="?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
                            <form method="post" style="display: inline;" id="fselect" action=".">
                            </form>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($usuarios as $indice => $usuario) { ?>
                        <tr>
                            <td><?= $usuario->getEmail() ?></td>
                            <td><?= $usuario->getNombre()?> <?= $usuario->getApellidos()?></td>
                            <td><?= $usuario->getCiudad() ?></td>
                            <td><?= $usuario->getPais() ?></td>
                            <td><?= $usuario->getAlias() ?></td>
                            <td><?= $usuario->getFechaalta() ?></td>
                            <td><?= $usuario->getActivo() ?></td>
                            <td><?= $usuario->getAdministrador() ?></td>
                            <td>
                                <a class='borrar' href='../admin/phpdelete.php?Code=<?= $usuario->getEmail() ?>'>borrar</a> 
                                <a href='../admin/vieweditadmin.php?ID=<?= $usuario->getEmail() ?>'>editar</a>
                                <a href='../controlUsuario/viewPhotos.php?ID=<?= $usuario->getEmail() ?>'>galeria</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            <div class="logout"><a class="enlace" href="../login/phplogout.php">Logout</a></div>
            </div>
            <script src="../js/scripts.js"></script>
    </body>
</html>
<?php
$bd->close();
