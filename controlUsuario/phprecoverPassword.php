<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();
$correo = Request::post("email");
$enviarMail = new SendGoogleMail();
 
foreach ($usuarios as $indice => $usuario) { 
    if($usuario->getEmail() == $correo){
        echo 'Este correo existe';
        $titulo = 'Recuperacion de contraseña';
        $activacion = sha1($correo . Constant::SEMILLA);
        $enviarMail->sendActivationMail2($correo, $titulo, "$titulo  https://galeria-jjorgosogarcia.c9users.io/usuario/cambiarClave.php?correo=$correo&activacion=$activacion");
        header("Location:../usuario/confirmacion.php?op=mail");
        break;
    } else{
        echo 'Este correo no existe';
        header("Location:../login/nologin.php?op=nologin");
    }  
}
