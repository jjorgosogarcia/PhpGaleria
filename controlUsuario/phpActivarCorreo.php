<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();
$correo = Request::get("correo");
$usuario = $gestor->get($correo);
$semilla = Request::get("activacion");
$activar = sha1($correo . Constant::SEMILLA);



foreach ($usuarios as $indice => $usuario) { 
   if( $correo == $usuario->getEmail() && $activar == $semilla){
      
       $usuario->setActivo(1);

         $r = $gestor->set($usuario, $correo);
       break;
   }else{
       echo 'Este email no esta registrado';
       echo "<br><br> El mail es $correo y la semilla es $semilla y la activacion es $activar";
   }
       
}

header("Location:../usuario/confirmacion.php?op=activado");