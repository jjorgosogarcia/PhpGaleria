<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$code = Request::get("Code");
$f = Request::get("f");
if($f===null){
    $r = $gestor->delete($code); 
}else{
    $r = $gestor->forzarDelete($code);
}
$bd->close();
header("Location:index.php?op=eliminado&r=$r");