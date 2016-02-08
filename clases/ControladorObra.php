<?php

class ControladorObra {

    static function handle() {
        $bd = new DataBase();
        $gestor = new ManageObra($bd);
        $sesion = new Session();
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        if (method_exists(get_class(), $metodo)) { //ucfirst pone la primera en mayuscula
            echo 'El método existe';
            self::$metodo($gestor,$sesion);
        } else {
            echo 'la función no existe';
            self::readView($gestor,$sesion);
        }
        $bd->close();
    }
    
    private static function deleteSet($gestor,$sesion){
        $idCuadro = Request::get('IDCU');
        echo $idCuadro;
        $gestor->delete($idCuadro);
        //ControladorObraUsuario::readView($gestor,$sesion);
        
    }
    
    private static function insertCuadro($gestor,$sesion){
    $obras = new Obra();
    $obras->read();
    $usuario = $sesion->getUser();
    $nombreCuadro = Request::post('nombre');
    $obras->setId_usuario($usuario);
    /*Subir fotografia*/
    $subir = new FileUpload("imagen");
    $subir->setDestino("../../controlUsuario/cuadros/$usuario/");
    $subir->setTamaño(100000000);
    $subir->setNombre($nombreCuadro);
    $subir->setPolitica(FileUpload::REEMPLAZAR);
    if($subir->upload()){
        echo 'Archivo subido con éxito';
    } else{
        echo 'Archivo no subido';
    }
    $obras->setImagen($nombreCuadro.".".$subir->getExtension());
    $r = $gestor->insert($obras);
    echo $r;
    //header("Location:../admin/index.php?op=añadido&r=$r");
    }
    
    private static function editCuadro($gestor,$sesion){
        $obra = new Obra();
        $obra->read();
        $pkID = Request::post("pkID");
        $nombre = Request::post("nombre");
        $email = Request::post('email');
        $usuario = $sesion->getUser();
        $obra->setId_usuario($usuario);
        /*Subir fotografia*/
        $subir= new FileUpload("nuevaImagen");
        $subir->setDestino("../../controlUsuario/cuadros/$usuario/");
        $subir->setTamaño(100000000);
        $subir->setNombre($nombre);
        $subir->setPolitica(FileUpload::REEMPLAZAR);
        if($subir->upload()){
            echo 'Archivo subido con éxito';
            $obra->setImagen($nombre.".".$subir->getExtension());
        } else{
            echo 'Archivo no subido';
        }
        $obra->setImagen($nombre.".".$subir->getExtension());
        $r = $gestor->set($obra, $pkID);
        echo $r;
        //header("Location:index.php?op=edit&r=$r");
    }
    

 private static function readView($gestor,$sesion) {
        $user = $sesion->getUser();
        $listaobras = $gestor->getListUsuario("id_usuario = '$user'");
        $plantillaObra = file_get_contents("obras.html");
        $contenido = file_get_contents("index.html");
        $obras = "";
        foreach ($listaobras as $key => $value) {
            $obrai = str_replace("{descripcion}", $value->getDescripcion(), $plantillaObra);
            $obrai = str_replace("{IDU}", $value->getId_usuario(), $obrai);
            $obrai = str_replace("{imagen}", $value->getImagen(), $obrai);
            $obrai = str_replace("{idcuadro}", $value->getId_cuadro(), $obrai);
            $obras.= $obrai;
        }
        $contenido = str_replace('{contenido}',$obras,$contenido);
        echo $contenido;
    }

}
