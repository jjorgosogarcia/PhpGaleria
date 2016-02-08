<?php


class User {
    
    private $email, $clave, $nombre, $apellidos, $pais, $ciudad, $alias, $imagen,
            $fechaalta, $activo, $administrador, $plantilla;
    
    function __construct($email=null, $clave=null, $nombre=null, $apellidos=null,
            $pais=null, $ciudad=null, $alias=null, $imagen=null,
            $fechaalta=null, $activo=0, $administrador=0, $plantilla=null) {
        $this->email = $email;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->pais = $pais;
        $this->ciudad = $ciudad;
        $this->alias = $alias;
        $this->imagen = $imagen;
        $this->fechaalta = $fechaalta;
        $this->activo = $activo;
        $this->administrador = $administrador;
        $this->plantilla = $plantilla;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getClave() {
        return $this->clave;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getPais() {
        return $this->pais;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getAlias() {
        return $this->alias;
    }
    
    function getImagen() {
        return $this->imagen;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getActivo() {
        return $this->activo;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function getPlantilla() {
        return $this->plantilla;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setAlias($alias) {
        $this->alias = $alias;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

    function setPlantilla($plantilla) {
        $this->plantilla = $plantilla;
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
