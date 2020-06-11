<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection;

if(isset($_POST["dates"])){

    if(isset($_POST["fmc"]) && isset($_POST["fyc"])){

        $mc = $_POST["fmc"];
        $yc = $_POST["fyc"];

        echo json_encode([
            "mc"=>strftime($mc, strtotime('today')),
            "yc"=>strftime($yc, strtotime('today'))
        ]);

    }

}

if(isset($_POST["formato"])){
    
    $formato = $_POST["formato"];

    echo strftime($formato, strtotime('today'));

}

if(isset($_POST["mesNum"])){

    $mn = $_POST["mesNum"];
    $mn = "0000-$mn-00";

    $sql = "select date_format(?,'%M') mes;";

    $con = Connection::getConnection();

    $ps = $con->prepare($sql);
    $ps->bindParam(1,$mn);
    $ps->execute();

    $row = $ps->fetch(PDO::FETCH_OBJ);

    echo $row->mes;

}