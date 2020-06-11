<?php

namespace App\Model\DAO;

use App\Aux\Connection,
    PDO;

class DateDAO {

    private $con;
    
    function __construct(){

        $this->con = Connection::getConnection();
    }
    
    public function dateSearch($s){
    
        $sql = "select date_format('0000-$s-00','%M') mes ;";

        $ps = $this->con->query($sql);

        $row = $ps->fetch(PDO::FETCH_OBJ);

        return $row->mes;

    }

}

