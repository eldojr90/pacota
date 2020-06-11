<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection;

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $sql = "delete from comissao "
            . "where c_id = ?";
    
    $con = Connection::getConnection();
    
    $ps = $con->prepare($sql);
    $ps->bindParam(1, $id);

    if($ps->execute()){
    
        header("location: ../../home.php");
        
    }else{
        
        echo "pal";
        
    }
}
