<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = new User();
$usuarios->read();
$enviarMail = new SendGoogleMail();

/*Crear Alias*/
$correo = Request::post("email");
$alias = explode("@", $correo);
$usuarios->setAlias($alias[0]);

/*Ponemos privilegios a 0*/
$usuarios->setActivo(0);
$usuarios->setAdministrador(0);

/*Creamos la fecha de registro*/
$time = time();
$fecha = date("Y-m-d", $time);
$usuarios->setFechaalta($fecha);


/*Mandamos un email al usuario para que active su cuenta*/

$titulo = 'Activacion de la cuenta';
$activacion = sha1($correo . Constant::SEMILLA);
$enviarMail->sendActivationMail2($correo, $titulo, "$titulo  https://galeria-jjorgosogarcia.c9users.io/controlUsuario/phpActivarCorreo.php?correo=$correo&activacion=$activacion");


$r = $gestor->insert($usuarios);
$bd->close();

//echo $r;
//var_dump($bd->getError());

header("Location:../usuario/confirmacion.php?op=mail");

