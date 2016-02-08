<?php


class ManageObra {
    private $bd = null;
    private $tabla = "cuadro";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP){
        $ordenPredeterminado = "$orden, id_usuario, fecha";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "id_usuario, fecha";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $obra = new Obra();
             $obra->set($fila);
             $r[]=$obra;
         }
         return $r;
    }
    
    function getListUsuario($condicion = null,$pagina=1, $orden="", $nrpp=Constant::NRPP){
        $ordenPredeterminado = "$orden, id_usuario, fecha";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "id_usuario, fecha";
        }
        if($condicion === null){
            $condicion = "1=1";
        }else{
            $condicion = " $condicion";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", $condicion, array(), $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $obra = new Obra();
             $obra->set($fila);
             $r[]=$obra;
         }
         return $r;
    }
    

    
    function get($ID){
        $parametros = array();
        $parametros['ID'] = $ID;
        $this->bd->select($this->tabla, "*", "id_cuadro=:ID", $parametros);
        $fila=$this->bd->getRow();
        $obra = new Obra();
        $obra->set($fila);
        return $obra;
    }
    
    function delete($Code){
        $parametros = array();
        $parametros['id_cuadro'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Obra $obra){
        return $this->delete($obra);
    }
    
    function set(Obra $obra, $pkCode){
        $parametros = $obra->getArray();
        $parametrosWhere = array();
        $parametrosWhere["id_cuadro"] = $pkCode;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
   
    public function insert(Obra $obra){
        $parametros = $obra->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getValuesSelect(){
        $this->bd->query($this->tabla, "id_cuadro", array(), "id_cuadro");
        $array = array();
        while($fila=$this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
        
    function count($condicion="1 = 1", $parametros = array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    
}
