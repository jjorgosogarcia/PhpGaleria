<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = new User();
$usuarios->read();

$pkID = Request::post("pkID");
$usuarios->setImagen($usuarios->getImagen());


$r = $gestor->set($usuarios, $pkID);

$bd->close();
//echo $r;
//var_dump($bd->getError());

header("Location:../admin/index.php?op=editado&r=$r");





