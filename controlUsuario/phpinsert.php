<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = new User();
$usuarios->read();

/*$usuarios->setActivo(0);
$usuarios->setAdministrador(0);
$usuarios->setPersonal(0);
*/

/*Crear Alias*/
$correo = Request::post("email");
$alias = explode("@", $correo);
$usuarios->setAlias($alias[0]);

/*Creamos la fecha de registro*/
$time = time();
$fecha = date("Y-m-d", $time);
$usuarios->setFechaalta($fecha);

/*Subir fotografia*/
$subir= new FileUpload("imagen");
$subir->setDestino("./avatares/");
$subir->setTamaño(100000000);
$subir->setNombre($correo.".".$subir->getExtension());
$subir->setPolitica(FileUpload::REEMPLAZAR);
if($subir->upload()){
    echo 'Archivo subido con éxito';
} else{
    echo 'Archivo no subido';
}

$usuarios->setImagen($correo.".".$subir->getExtension());


$r = $gestor->insert($usuarios);
$bd->close();

//echo $r;
//var_dump($bd->getError());

header("Location:../admin/index.php?op=añadido&r=$r");