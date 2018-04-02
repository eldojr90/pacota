<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection;

session_start();

$idUsuario = $_SESSION["idUsuario"];

if(isset($_POST["tabMensal"])){
    
    if($_POST["tabMensal"]==TRUE){
    
        $sql = 'SELECT c_id, date_format(c_data,"%d") dia, c_valor, (c_valor/2) c_ind 
                FROM comissao WHERE u_id = ? AND
                date_format(current_date,"%m/%y") = date_format(c_data,"%m/%y")
                ORDER BY dia DESC';
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        
        populaTabMensal($ps);

    }

}    

if(isset($_POST["totalMensal"])){
    
    if($_POST["totalMensal"]==TRUE){
    
        $sql = 'SELECT sum(c_valor) c_total_mes '
                . 'FROM comissao '
                . 'WHERE (date_format(c_data,"%m/%y") = date_format(CURRENT_TIMESTAMP,"%m/%y")) '
                . 'AND u_id = ?';
    
        $con = Connection::getConnection();
    
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
    
        totalMensal($ps);
        
    }

}

if(isset($_POST["totalMensalInd"])){
    
    if($_POST["totalMensalInd"]==TRUE){
    
        $sql = 'SELECT (sum(c_valor)/2) c_total_mes '
                . 'FROM comissao '
                . 'WHERE (date_format(c_data,"%m/%y") = date_format(CURRENT_TIMESTAMP,"%m/%y")) '
                . 'AND u_id = ?';
    
        $con = Connection::getConnection();
    
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
    
        totalMensal($ps);
        
    }

}

if(isset($_POST["tabAnual"])){
    
    if($_POST["tabAnual"]==TRUE){
        
        $sql = 'SELECT date_format(c_data,"%M") mes, sum(c_valor) total_mes, (sum(c_valor)/2) total_ind , 
                date_format(c_data, "%m/%Y") ms
                FROM comissao WHERE u_id = ? AND
                date_format(current_date,"%y") = date_format(c_data,"%y") 
                GROUP BY mes
                ORDER BY c_data DESC;';
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        
        populaTabAnual($ps);

    }

}    

if(isset($_POST["totalAnual"])){
    
    if($_POST["totalAnual"]==TRUE){
        
        $sql = "SELECT sum(c_valor) c_total_ano
                FROM 
                comissao 
                WHERE u_id = ? AND 
                date_format(c_data,'%y') = date_format(current_date,'%y');";
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        
        totalAnual($ps);

    }

}

if(isset($_POST["totalAnualInd"])){
    
    if($_POST["totalAnualInd"]==TRUE){
        
        $sql = "SELECT (sum(c_valor)/2) c_total_ano
                FROM 
                comissao 
                WHERE u_id = ? AND 
                date_format(c_data,'%y') = date_format(current_date,'%y');";
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        
        totalAnual($ps);

    }

}  

if(isset($_POST["tabSemp"])){

    if($_POST["tabSemp"]==TRUE){
        
        $sql = 'SELECT date_format(c_data,"%Y") ano, sum(c_valor) total_ano, (sum(c_valor)/2) total_ind
                FROM comissao WHERE u_id = ?
                GROUP BY ano
                ORDER BY ano DESC;';
        
        $con = Connection::getConnection();
        
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        
        $count = $ps->rowCount();
        
        if($count>0){
            while($row = $ps->fetch(PDO::FETCH_OBJ)){
                echo    "<tr>
                            <td><i class='pe-7s-date'></i>&nbsp <a href='anual.php?ys=$row->ano'>$row->ano</a></td>
                            <td>R$&nbsp".number_format($row->total_ano, 2, ',', '.')."</td>
                            <td>R$&nbsp".number_format($row->total_ind, 2, ',', '.')."</td>
                        </tr>";
            }
        }

    }

}    

if(isset($_POST["totalSemp"])){
    if($_POST["totalSemp"]==TRUE){
        $sql = "SELECT sum(c_valor) c_total
                FROM comissao WHERE u_id = ?;";
        $con = Connection::getConnection();
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        $count = $ps->rowCount();
        if($count>0){
            while($row = $ps->fetch(PDO::FETCH_OBJ)){
                echo number_format($row->c_total, 2, ',', '.');
            }
        }else{
            echo 0;
        }
    }
}  

if(isset($_POST["totalSempInd"])){
    if($_POST["totalSempInd"]==TRUE){
        $sql = "SELECT (sum(c_valor)/2) c_total
                FROM comissao WHERE u_id = ?;";
        $con = Connection::getConnection();
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $idUsuario);
        $ps->execute();
        $count = $ps->rowCount();
        if($count>0){
            while($row = $ps->fetch(PDO::FETCH_OBJ)){
                echo number_format($row->c_total, 2, ',', '.');
            }
        }else{
            echo 0;
        }
    }
}  

if(isset($_POST["since"])){

    $sql = "SELECT date_format(min(c_data),'%Y') since FROM comissao WHERE u_id = ?";

    $con = Connection::getConnection();

    $ps = $con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->execute();

    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    echo "Desde $row->since";

}

if(isset($_POST["yearsAvailable"])){

    $sql = "SELECT distinct date_format(c_data,'%Y') ano 
            FROM comissao 
            WHERE u_id = ?
            ORDER BY c_data DESC;";

    $con = Connection::getConnection();

    $ps = $con->prepare($sql);
    $ps->bindParam(1,$idUsuario);
    $ps->execute();


    echo "<option class='primeiro' value='' SELECTed>Ano</option>";

    while($row = $ps->fetch(PDO::FETCH_OBJ)){
        echo "<option value='$row->ano'>$row->ano</option>";
    }

}

if(isset($_POST["monthsAvailable"])){
    
    if(isset($_POST["year"])){

        $year = $_POST["year"];

        $sql = "SELECT distinct date_format(c_data,'%M') mesExt, date_format(c_data,'%m') mes
            FROM comissao 
            WHERE date_format(c_data,'%Y') = ? AND
            u_id = ?
            ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$year);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        echo "<option class='primeiro' value='' SELECTed>Mês</option>";

        while($row = $ps->fetch(PDO::FETCH_OBJ)){
            $mesNum = $row->mes;
            $mesExt = strtoupper(substr($row->mesExt,0,1)).substr($row->mesExt,1);
            echo "<option value='$mesNum'> ($mesNum) - $mesExt</option>";
        }


    }

    

}

if(isset($_POST["tabMensalSrc"])){

    if(isset($_POST["monthRef"])){

        $mr = $_POST["monthRef"];

        $sql = "SELECT c_id, date_format(c_data,'%d') dia, c_valor, (c_valor/2) c_ind
                FROM comissao 
                WHERE date_format(c_data, '%m/%Y') = ? AND
                u_id = ?
                ORDER BY c_data DESC;";
        
        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$mr);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        populaTabMensal($ps);

    }

}

if(isset($_POST["totalMonthRef"])){

    if(isset($_POST["monthRef"])){

        $mr = $_POST["monthRef"];

        $sql = "SELECT sum(c_valor) c_total_mes
                FROM comissao 
                WHERE date_format(c_data, '%m/%Y') = ? AND
                u_id = ?
                ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$mr);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        totalMensal($ps);

    }

}

if(isset($_POST["totalMonthRefInd"])){

    if(isset($_POST["monthRef"])){

        $mr = $_POST["monthRef"];

        $sql = "SELECT (sum(c_valor)/2) c_total_mes
                FROM comissao 
                WHERE date_format(c_data, '%m/%Y') = ? AND
                u_id = ?
                ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$mr);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        totalMensal($ps);

    }

}

if(isset($_POST["tabAnualSrc"])){
    
    if(isset($_POST["year"])){
        
        $year = $_POST["year"];

        $sql = "SELECT date_format(c_data,'%M') mes, sum(c_valor) total_mes, (sum(c_valor)/2) total_ind, date_format(c_data, '%m/%Y') ms
                FROM comissao
                WHERE date_format(c_data,'%Y') = ? AND
                u_id = ?
                group by mes
                ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$year);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        populaTabAnual($ps);

    }

}

if(isset($_POST["totalAnualSrc"])){

    if(isset($_POST["year"])){
        
        $year = $_POST["year"];

        $sql = "SELECT sum(c_valor) c_total_ano 
                FROM comissao 
                WHERE date_format(c_data, '%Y') = ? AND
                u_id = ?
                ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$year);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        totalAnual($ps);


    }

}

if(isset($_POST["totalAnualSrcInd"])){

    if(isset($_POST["year"])){
        
        $year = $_POST["year"];

        $sql = "SELECT (sum(c_valor)/2) c_total_ano 
                FROM comissao 
                WHERE date_format(c_data, '%Y') = ? AND
                u_id = ?
                ORDER BY c_data DESC";

        $con = Connection::getConnection();

        $ps = $con->prepare($sql);
        $ps->bindParam(1,$year);
        $ps->bindParam(2,$idUsuario);
        $ps->execute();

        totalAnual($ps);


    }

}

function populaTabMensal($st){
    while($row = $st->fetch(PDO::FETCH_OBJ)){
        echo    "<tr>
                    <td><i class='pe-7s-date'></i>&nbsp$row->dia</td><td>R$&nbsp".number_format($row->c_valor, 2, ',', '.').
                    "</td>
                    <td>R$&nbsp".number_format($row->c_ind, 2, ',', '.')."</td>
                    <td><a href='../../app/Controller/comissaoDelete.php?id=$row->c_id'><i style='font-size:1.5em' class='pe-7s-trash'></i></a></td>
                </tr> \n";
    }
}

function populaTabAnual($st){
    while($row = $st->fetch(PDO::FETCH_OBJ)){

        $mes = strtoupper(substr($row->mes,0,1)).substr($row->mes,1);

        echo   "<tr>
                    <td>
                        <i class='pe-7s-date'></i>&nbsp <a href='mensal.php?ms=$row->ms'>$mes</a>
                    <td>
                        R$&nbsp".number_format($row->total_mes, 2, ',', '.').
                    "</td>
                    <td>
                        R$&nbsp".number_format($row->total_ind, 2, ',', '.').
                    "</td>
                    <td></td>
                </tr>";
    }

}

function totalMensal($st){
    while($row = $st->fetch(PDO::FETCH_OBJ)){
    
        echo number_format($row->c_total_mes, 2, ',', '.');

    
    }
}

function totalAnual($st){

    $row = $st->fetch(PDO::FETCH_OBJ);
    
    echo number_format($row->c_total_ano, 2, ',', '.');

}