<?php

class ControladorUser {

    static function handle() {
        $bd = new DataBase();
        $gestor = new ManageUser($bd);
        $sesion = new Session();
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        if (method_exists(get_class(), $metodo)) { //ucfirst pone la primera en mayuscula
            echo 'El método existe';
            self::$metodo($gestor,$sesion);
        } else {
            echo 'la función no existe';
            self::readView($gestor);
        }
        $bd->close();
    }
    
    private static function deleteMe($gestor,$sesion){
        $user = new User();
        $user = $sesion->getUser();
        echo $user;
        $user= $gestor->get($user);
        echo $user->getNombre();
        echo $user->getActivo();
        $user->setActivo(0);
        $gestor->set($user, $user->getEmail());
        header("Location:../login/logout.php");
    }
    

    private static function readView($gestor) {
        $listausuarios = $gestor->getList();
        $plantillaUsuario = file_get_contents("usuarios.html");
        $contenido = file_get_contents("index.html");
        $usuarios = "";
        foreach ($listausuarios as $key => $value) {
            $usuarioi = str_replace("{nombreApellidos}", $value->getNombre() . " " . $value->getApellidos(), $plantillaUsuario);
            $usuarioi = str_replace("{Pais}", $value->getPais(), $usuarioi);
            if($value->getImagen()== NULL){ 
                $usuarioi = str_replace("{ruta}", 'noimage.jpg', $usuarioi);
            }else{ 
                $usuarioi = str_replace("{ruta}", $value->getImagen(), $usuarioi);
            }
            $usuarioi = str_replace("{email}", $value->getEmail(), $usuarioi);
            if($value->getPlantilla()== NULL){ 
               $usuarioi = str_replace("{plantilla}", 'Piccolo', $usuarioi);
            }else{ 
                $usuarioi = str_replace("{plantilla}", $value->getPlantilla(), $usuarioi);
            }
            $usuarios.= $usuarioi;
        }
        $contenido = str_replace('{contenido}',$usuarios,$contenido);
        echo $contenido;
    }

}
