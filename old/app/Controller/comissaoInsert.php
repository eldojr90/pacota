<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection,
    App\Model\Comissao,
    App\Model\Usuario;

session_start();

$idUsuario = $_SESSION["idUsuario"];

if(isset($_REQUEST)){
    
    if(isset($_POST)){
    
        if(isset($_POST["validaData"])){

            if(isset($_POST["dd"])){

                $dd = $_POST["dd"];

                echo existeComissaoByDia($dd,$idUsuario);

            }

        }

        if(isset($_POST["valor"])){

            $ld = lastDate($idUsuario);
            $ld = $ld["dd"];

            $c_valor = $_POST["valor"];
            $c_data = (isset($_POST["date"])?$_POST["date"]:$ld);

            if(validaData($c_data)){

                if(!existeComissaoByDia(isset($c_data)?$c_data:"curdate()",$idUsuario)){

                    $sql = "insert into comissao (u_id, c_valor,c_data) 
                            values (?,?,?);";
            
                    $con = Connection::getConnection();
            
                    $ps = $con->prepare($sql);
                    $ps->bindParam(1, $idUsuario);
                    $ps->bindParam(2, $c_valor);
                    $ps->bindParam(3, $c_data);
                        
                    if($ps->execute()){
            
                        echo 1;
            
                    }else{
            
                        echo 0;
            
                    }
                
                }else{

                    echo -1;

                }    
            
            }else{

                echo -2;

            }
    
        }

        if(isset($_POST["lastDate"])){

            $nextDate = lastDate($idUsuario);
            echo (existeComissaoByDia($nextDate["dd"],$idUsuario) || !validaData($nextDate["dd"])) ? 0 : $nextDate["df"];
        
        }
    
    }

    
}



if(isset($_POST["pends"])){

}

function lastDate($idUsuario){

    $sql = "SELECT date_format(adddate(max(c_data),interval 1 day),'%d/%m/%Y') c_data, 
                               adddate(max(c_data),interval 1 day) c_dd 
            FROM comissao 
            WHERE u_id = ?";

    $ps = (Connection::getConnection())->prepare($sql);
    $ps->bindParam(1,$idUsuario);
    $ps->execute();

    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $nextDate = [
        "df"=>(isset($row->c_data))?$row->c_data:null,
        "dd"=>(isset($row->c_dd))?$row->c_dd:null
    ];

    return $nextDate;

}

function existeComissaoByDia($dia,$idUsuario){

    $sql = "SELECT count(*) total 
            FROM comissao WHERE c_data = ? AND u_id = ?";

    $con = Connection::getConnection();

    $ps = $con->prepare($sql);
    
    if($dia!="curdate()"){
        
        $ps->bindParam(1,$dia);
        $ps->bindParam(2,$idUsuario);
        
    }else{
        
        $ps->bindParam(1,$idUsuario);
        
    }
    
    $ps->execute();

    $row = $ps->fetch(PDO::FETCH_OBJ);

    return $row->total != 0;

}

function validaData($data){

    $retorno = null;

    if($data == null){ 
        $retorno = true;
    }else{
        $retorno = strtotime($data) <= strtotime(date("Y-m-d"));
    }

    return $retorno;

}
