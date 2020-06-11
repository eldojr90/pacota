
<?php

require_once '../../vendor/autoload.php';

use App\Model\DAO\ComissaoDAO,
    App\Model\DAO\DateDAO,
    PDO;

session_start();

$cd = new ComissaoDAO();
$dd = new DateDAO();

$idUsuario = $_SESSION["idUsuario"];

if(isset($_POST["vals"])){

    //MES CORRENTE

    $ps = $cd->getMesCorrente($idUsuario);
    $mc = populaTabMensal($ps);

    $ps = $cd->getTMesCorrente($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $tmc = number_format($row->c_total_mes,2, ',', '.');
    $tmci = number_format($row->c_total_mes_ind,2, ',', '.');

    $month = $row->mes;

    //ANO CORRENTE

    $ps = $cd->getAnoCorrente($idUsuario);
    $tyc = populaTabAnual($ps);

    $ps = $cd->getTAnoCorrente($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $ttyc = number_format($row->c_total_ano,2, ',', '.');
    $ttyci = number_format($row->c_total_ano_ind,2, ',', '.');

    $year = $row->ano;

    //DE SEMPRE

    $ts = $cd->getSempre($idUsuario);

    $ps = $cd->getTSempre($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $tts = number_format($row->c_total, 2, ',', '.');
    $ttsi = number_format($row->c_total_ind, 2, ',', '.');
    
    $since =  $cd->getSince($idUsuario);

    echo json_encode([
       "m"=> $month,
       "ttm"=>$tmc,
       "ttmi"=>$tmci,
       "y"=>$year,
       "ty"=>$tyc,
       "tty"=>$ttyc,
       "ttyi"=>$ttyci,
       "sc"=>$since,
       "tf"=>$ts,
       "ttf"=>$tts, 
       "ttfi"=>$ttsi, 
       "tm"=>$mc
        /* 
        */
    ]);

}

if(isset($_POST["dCorMensal"])){

    $ps = $cd->getMesCorrente($idUsuario);
    $mc = populaTabMensal($ps);

    $ps = $cd->getTMesCorrente($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $tmc = number_format($row->c_total_mes,2, ',', '.');
    $tmci = number_format($row->c_total_mes_ind,2, ',', '.');

    $month = $row->mes;
    $year = $row->ano;

    echo json_encode([
        "m"=>$month,
        "y"=>$year,
        "mc"=>$mc,
        "tmc"=>$tmc,
        "tmci"=>$tmci
    ]);

}

if(isset($_POST["dCorAnual"])){

    $ps = $cd->getAnoCorrente($idUsuario);
    $tabAnual = populaTabAnual($ps);

    $ps = $cd->getTAnoCorrente($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    
    $tty = number_format($row->c_total_ano,2, ',', '.');
    $ttyi = number_format($row->c_total_ano_ind,2, ',', '.');

    $year = $row->ano;

    echo json_encode([
        "y"=>$year,
        "ty"=>$tabAnual,
        "tty"=>$tty,
        "ttyi"=>$ttyi
    ]);

}

if(isset($_POST["monthsAvailable"])){
    
    if(isset($_POST["year"])){

        $year = $_POST["year"];

        $ps = $cd->getMesDisp($year,$idUsuario);

        echo "<option class='primeiro' value='' selected>Mês</option>";

        while($row = $ps->fetch(PDO::FETCH_OBJ)){
            $mesNum = $row->mes;
            $mesExt = strtoupper(substr($row->mesExt,0,1)).substr($row->mesExt,1);
            echo "<option value='$mesNum'> ($mesNum) - $mesExt</option>";
        }

    }

}

if(isset($_POST["yearsAvailable"])){

    $ps = $cd->getAnosDisp($idUsuario);

    echo "<option class='primeiro' value='' selected>Ano</option>";

    while($row = $ps->fetch(PDO::FETCH_OBJ)){
        echo "<option value='$row->ano'>$row->ano</option>";
    }

}

if(isset($_POST["tabMensalSrc"])){

    if(isset($_POST["monthRef"]) && isset($_POST["mes"])){

        $mr = $_POST["monthRef"];
        $m = $_POST["mes"];

        $ms = populaTabMensal($cd->getMesSearch($mr,$idUsuario));
    
        $ps = $cd->getTMesRef($mr,$idUsuario);
        $row = $ps->fetch(PDO::FETCH_OBJ);
        
        $tms = number_format($row->c_total_mes,2, ',', '.');
        $tmsi = number_format($row->c_total_mes_ind,2, ',', '.');
    
        $month = $row->mes;
        $year = $row->ano;

        echo json_encode([
            "m" => $month,
            "y" => $year,
            "ms" => $ms,
            "tms" => $tms,
            "tmsi" => $tmsi
        ]);

    }

}

if(isset($_POST["dYSearch"])){
    
    if(isset($_POST["year"])){
        
        $year = $_POST["year"];

        $ys = populaTabAnual($cd->getAnoSearch($year,$idUsuario));

        $ps = $cd->getTAnoRef($year,$idUsuario);
        $row = $ps->fetch(PDO::FETCH_OBJ);
    
        $ttys = number_format($row->c_total_ano,2, ',', '.');
        $ttysi = number_format($row->c_total_ano_ind,2, ',', '.');

        $y = $row->ano;

        echo json_encode([
            "y"=>$y,
            "ys"=>$ys,
            "ttys"=>$ttys,
            "ttysi"=>$ttysi
        ]);

    }

}

function populaTabMensal($st){
    $content = [];
    
    while($row = $st->fetch(PDO::FETCH_OBJ)){
        
        $array_temp =["<tr>",
                    "<td><i class='pe-7s-date'></i>&nbsp$row->dia</td>
                    <td class='vals'>".number_format($row->c_valor, 2, ',', '.')."</td>",
                    "<td class='vals'>".number_format($row->c_ind, 2, ',', '.')."</td>",
                    "<td class='vals'> <a href='../../app/Controller/comissaoDelete.php?id=$row->c_id'><i style='font-size:1.5em' class='pe-7s-trash'></i></a></td>",
                    "</tr>"    
                ]; 
                
        array_push($content,$array_temp);
    }

    return $content;
}

function populaTabAnual($st){
    
    $content = [];
    
    while($row = $st->fetch(PDO::FETCH_OBJ)){

        $array_temp = [
                        "<tr>",
                        "<td><i class='pe-7s-date'></i>&nbsp<a href='mensal.php?ms=$row->ms'>$row->mes</a></td>",
                        "<td class='vals'>".number_format($row->total_mes, 2, ',', '.')."</td>",
                        "<td class='vals'>".number_format($row->total_ind, 2, ',', '.')."</td><td></td></tr>"
                    ];

        array_push($content, $array_temp);

    }

    return $content;

}

function imprimeArray($array){
    foreach($array as $linha){
        echo $linha;
    }
}

