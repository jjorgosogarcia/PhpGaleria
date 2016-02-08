<?php

class ControladorObraUsuario {

    static function handle() {
        $bd = new DataBase();
        $gestor = new ManageRelations($bd);
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        if (method_exists(get_class(), $metodo)) { //ucfirst pone la primera en mayuscula
            echo 'El método existe';
            self::$metodo($gestor);
        } else {
            echo 'la función no existe';
            self::readView($gestor);
        }
        $bd->close();
    }
    
    private static function deleteSet($gestor){
        $gestor->delete($gestor["cuadro"]->getId_cuadro());
        //ControladorObraUsuario::readView($gestor);
        //header("Location:?r=$r&op=delete");
    }

    private static function readView($gestor) {
        $sesion = new Session();
        $id2 = Request::get('ID');
        $listaObrasUsuario = $gestor->getCuadroAutor("cu.id_usuario = "."'$id2'");
        $plantillaObrasUsuario = file_get_contents("usuarios.html");
        $contenido = file_get_contents("index.html");
        $obrasUsuarios = "";
        foreach ($listaObrasUsuario as $key => $value) {
            $obraUi = str_replace("{id}", $value["autor"]->getEmail(), $plantillaObrasUsuario);
            $obraUi = str_replace("{ruta}", $value["cuadro"]->getImagen(), $obraUi);
            $obraUi = str_replace("{idCuadro}", $value["cuadro"]->getId_cuadro(), $obraUi);
            $obraUi = str_replace("{nombre}", $value["cuadro"]->getNombre(), $obraUi);
            $obraUi = str_replace("{descripcion}", $value["cuadro"]->getDescripcion(), $obraUi);
            $obrasUsuarios.= $obraUi;
        }
        $contenido = str_replace('{contenido}',$obrasUsuarios,$contenido);
        echo $contenido;
    }

}
