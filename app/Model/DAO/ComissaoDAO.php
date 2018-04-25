<?php

namespace App\Model\DAO;

use App\Aux\Connection,
App\Model\Comissao,
PDO;

class ComissaoDAO {

private $con;

function __construct(){
    
    $this->con = Connection::getConnection();

}

public function getComissao($id){

    $comissao = null;
    
    $sql = "select *, date_format(c_data,'%d/%m/%y %H:%m:%s') data "
            . "from comissao where c_id = ?";
    
    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $id);
    
    $row = $ps->fetch(PDO::FETCH_OBJ);

    return new Comissao($row->c_id, $row->data, $row->c_valor, $row->u_id);
    
}

public function getMesCorrente($idUsuario){
    
    $sql = 'SELECT c_id, date_format(c_data,"%d") dia, c_valor, (c_valor/2) c_ind,
            date_format(c_data,"%M") mes, date_format(c_data,"%Y") ano 
            FROM comissao WHERE u_id = ? AND
            date_format(c_data,"%m/%y") = date_format((SELECT max(c_data)
                                                    FROM comissao	
                                                    WHERE u_id = ?),"%m/%y")
            ORDER BY dia DESC;';

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->bindParam(2, $idUsuario);
    $ps->execute();

    return $ps;
    
}

public function getAnoCorrente($idUsuario){

    $sql = 'SELECT date_format(c_data,"%M") mes, sum(c_valor) total_mes, (sum(c_valor)/2) total_ind , 
            date_format(c_data, "%m/%Y") ms
            FROM comissao WHERE u_id = ? AND
            date_format(c_data,"%y") = date_format((SELECT max(c_data)
                                                        FROM comissao
                                                        WHERE u_id = ?),"%y") 
            GROUP BY mes
            ORDER BY c_data DESC;';

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->bindParam(2, $idUsuario);
    $ps->execute();

    return $ps;

}

public function getSempre($idUsuario){
    
    $sql = 'SELECT date_format(c_data,"%Y") ano, sum(c_valor) total_ano, 
                    (sum(c_valor)/2) total_ind
            FROM comissao WHERE u_id = ?
            GROUP BY ano
            ORDER BY ano DESC;';

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->execute();
    
    $ts = [];

    while($row = $ps->fetch(PDO::FETCH_OBJ)){
        $array_temp =[
                        "<tr><td><i class='pe-7s-date'></i>&nbsp <a href='anual.php?ys=$row->ano'>$row->ano</a></td>",
                        "<td class='vals'>".number_format($row->total_ano, 2, ',', '.')."</td>",
                        "<td class='vals'>".number_format($row->total_ind, 2, ',', '.')."</td></tr>"
                    ];

        array_push($ts, $array_temp);
    }

    return $ts;
}

public function getSince($idUsuario){

    $sql = "SELECT date_format(min(c_data),'%Y') since 
            FROM comissao 
            WHERE u_id = ?";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->execute();

    $row = $ps->fetch(PDO::FETCH_OBJ);

    return "Desde $row->since";

}

public function getTMesCorrente($idUsuario){

    $sql = 'SELECT sum(c_valor) c_total_mes, (sum(c_valor)/2) c_total_mes_ind, 
                   date_format(c_data,"%M") mes, date_format(c_data,"%Y") ano
            FROM comissao
            WHERE (date_format(c_data,"%m/%y") = date_format((SELECT max(c_data) 
                                                            FROM comissao 
                                                            WHERE u_id = ?),"%m/%y")) 
            AND u_id = ?;';

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->bindParam(2, $idUsuario);
    $ps->execute();

    return $ps;

}

public function getTAnoCorrente($idUsuario){

    $sql = "SELECT sum(c_valor) c_total_ano, (sum(c_valor)/2) c_total_ano_ind, date_format(c_data,'%Y') ano
        FROM comissao 
        WHERE u_id = ? AND 
        date_format(c_data,'%y') = date_format((SELECT max(c_data) 
                                                FROM comissao 
                                                WHERE u_id = ?),'%y');";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->bindParam(2, $idUsuario);
    $ps->execute();

    return $ps;
}

public function getTSempre($idUsuario){
    
    $sql = "SELECT sum(c_valor) c_total, (sum(c_valor)/2) c_total_ind
            FROM comissao 
            WHERE u_id = ?;";
    
    $ps = $this->con->prepare($sql);
    $ps->bindParam(1, $idUsuario);
    $ps->execute();

    return $ps;

}

public function getMesDisp($ano, $idUsuario){
    
    $sql = "SELECT distinct date_format(c_data,'%M') mesExt, date_format(c_data,'%m') mes
        FROM comissao 
        WHERE date_format(c_data,'%Y') = ? AND
        u_id = ?
        ORDER BY c_data DESC";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1,$ano);
    $ps->bindParam(2,$idUsuario);
    $ps->execute();

    return $ps;

}

public function getAnosDisp($idUsuario){

    $sql = "SELECT distinct date_format(c_data,'%Y') ano 
        FROM comissao 
        WHERE u_id = ?
        ORDER BY c_data DESC;";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1,$idUsuario);
    $ps->execute();

    return $ps;

}

public function getMesSearch($mr,$idUsuario){
    
    $sql = "SELECT c_id, date_format(c_data,'%d') dia, c_valor, (c_valor/2) c_ind, 
            date_format(c_data,'%M') mes, date_format(c_data,'%Y') ano
            FROM comissao 
            WHERE date_format(c_data, '%m/%Y') = ? AND
            u_id = ?
            ORDER BY c_data DESC;";
    
    $ps = $this->con->prepare($sql);
    $ps->bindParam(1,$mr);
    $ps->bindParam(2,$idUsuario);
    $ps->execute();

    return $ps;

}

public function getAnoSearch($year,$idUsuario){
    
    $sql = "SELECT date_format(c_data,'%M') mes, sum(c_valor) total_mes, (sum(c_valor)/2) total_ind, 
            date_format(c_data, '%m/%Y') ms
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

    return $ps;
}

public function getTMesRef($mr,$idUsuario){

    
    $sql = "SELECT sum(c_valor) c_total_mes, (sum(c_valor)/2) c_total_mes_ind,
                   date_format(c_data,'%M') mes, date_format(c_data,'%Y') ano
            FROM comissao 
            WHERE date_format(c_data, '%m/%Y') = ? AND
            u_id = ?
            ORDER BY c_data DESC";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1,$mr);
    $ps->bindParam(2,$idUsuario);
    $ps->execute();

    return $ps;
}

public function getTAnoRef($year,$idUsuario){
    
    $sql = "SELECT sum(c_valor) c_total_ano, sum(c_valor/2) c_total_ano_ind, date_format(c_data, '%Y') ano
            FROM comissao 
            WHERE date_format(c_data, '%Y') = ? AND
            u_id = ?
            ORDER BY c_data DESC";

    $ps = $this->con->prepare($sql);
    $ps->bindParam(1,$year);
    $ps->bindParam(2,$idUsuario);
    $ps->execute();

    return $ps;
}

}