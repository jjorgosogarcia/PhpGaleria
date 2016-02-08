<?php


class ManageUser {
    private $bd = null;
    private $tabla = "autor";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP){
        $ordenPredeterminado = "$orden, email, fechaalta";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "email, fechaalta";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $user = new User();
             $user->set($fila);
             $r[]=$user;
         }
         return $r;
    }
    
    function get($ID){
        $parametros = array();
        $parametros['ID'] = $ID;
        $this->bd->select($this->tabla, "*", "email=:ID", $parametros);
        $fila=$this->bd->getRow();
        $user = new User();
        $user->set($fila);
        return $user;
    }
    
    function delete($Code){
        $parametros = array();
        $parametros['email'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(User $user){
        return $this->delete($user);
    }
    
    function set(User $user, $pkCode){
        $parametros = $user->getArray();
        $parametrosWhere = array();
        $parametrosWhere["email"] = $pkCode;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
   
    public function insert(User $user){
        $usuario = new User();
        $usuario = $user;
        $usuario->setClave(sha1($usuario->getClave()));
        $parametros = $user->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getValuesSelect(){
        $this->bd->query($this->tabla, "email", array(), "email");
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
