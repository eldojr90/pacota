<?php

namespace App\Model\DAO;

use App\Aux\Connection,
    App\Model\Comissao,
    PDO;

class ComissaoDAO {
    
    function getComissao($id){
    
        $comissao = null;
        
        $sql = "select *, date_format(c_data,'%d/%m/%y %H:%m:%s') data "
                . "from comissao where c_id = ?";
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $id);
        
        if($ps->execute()){
        
            if($row = $ps->fetch(PDO::FETCH_OBJ)){

                $comissao = new Comissao($row->c_id, $row->data, $row->c_valor, $row->u_id);
            
            }
        
        }
        
        return $comissao;
    
    }
    
}
