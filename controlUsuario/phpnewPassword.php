<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();

$newPassword = Request::post("clave");
$correo = Request::post("email");
$semilla = Request::post("activacion");
$activar = sha1($correo . Constant::SEMILLA);

$usuario = $gestor->get($correo);

foreach ($usuarios as $indice => $usuario) { 
   if($correo == $usuario->getEmail() && $activar == $semilla){
       $usuario->setClave(sha1($newPassword));
         $r = $gestor->set($usuario, $correo);
       break;
   }else{
       echo 'Este email no esta registrado';
   }
       
}

header("Location:../usuario/confirmacion.php?op=activado");