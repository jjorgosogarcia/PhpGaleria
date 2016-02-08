<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();

$user = Request::post("email");
$password = sha1(Request::post("password"));
$sesion = new Session();
 
foreach ($usuarios as $indice => $usuario) { 
   if($user == $usuario->getEmail() && $password == $usuario->getClave()){
       if($usuario->getAdministrador()== 1){
            header("Location:../admin/index.php");
       }

       if($usuario->getAdministrador()== 0 &&  
               $usuario->getActivo()== 1){
           header("Location:../acceso/indexBaja.php");
       }
       if($usuario->getAdministrador()== 0 && $usuario->getActivo()==0){
            header("Location:../acceso/indexBaja.php");
       }
       
     $sesion->set("email", $user);
       break;
   }else{
       echo "NO LOGINN";
       echo "<br/> $user $password";
       echo "<br>".$usuario->getClave();
       header("Location:nologin.php?op=nologin");
   }
        
       //header("Location:../acceso/indexBaja.php");
}
