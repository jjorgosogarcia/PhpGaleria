<?php

class obra {
    
    private $id_cuadro, $id_usuario, $imagen, $nombre, $descripcion, $fecha;
    function __construct($id_cuadro = null, $id_usuario = null, $nombre = null,
            $descripcion = null, $fecha = null) {
        $this->id_cuadro = $id_cuadro;
        $this->id_usuario = $id_usuario;
        $this->imagen = $imagen;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
    }

    function getId_cuadro() {
        return $this->id_cuadro;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }
    
    function getImagen() {
        return $this->imagen;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId_cuadro($id_cuadro) {
        $this->id_cuadro = $id_cuadro;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

 //3º getJson
    public function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' .$indice . '":"' .$valor. '",';
        }
        $r = substr($r, 0,-1);
        $r .='}';
        return $r;
    }
    
    //4º set genérico    
    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r ='';
        foreach ($this as $key => $valor) { 
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores = true){
        $array = array();
        foreach ($this as $key => $valor) {
            if($valores === true){
                $array[$key] = $valor;
            }else{
                $array[$key]=null;
            }
        }
        return $array;
    }
    
    function read(){
        foreach ($this as $key => $valor) {
            $this->$key = Request::req($key);
        }
    }

}
