<?php

class ManageRelations {

    private $bd = null;
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
     function getCuadroAutor($condicion = null, $parametros = array()){
        if($condicion === null){
            $condicion = "";
        }else{
            $condicion = "where $condicion";
        }
        $sql = "select au.*, cu.* from autor au 
                    left join cuadro cu on cu.id_usuario = au.email 
                $condicion ORDER BY au.email, cu.fecha desc ";

         $this->bd->send($sql, $parametros);
         $r=array();
         $contador = 0;
         while($fila =$this->bd->getRow()){
             $usuario = new User();
             $usuario->set($fila);
             $obra = new Obra();
             $obra->set($fila, 12);
             $r[$contador]["autor"]=$usuario;
             $r[$contador]["cuadro"]=$obra;
             $contador++;
         }
         return $r;
    }
    
}
