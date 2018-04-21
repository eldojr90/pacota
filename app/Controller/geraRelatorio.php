
<?php

require_once '../../vendor/autoload.php';

use App\Model\DAO\ComissaoDAO,
    App\Model\DAO\DateDAO;

session_start();

$cd = new ComissaoDAO();
$dd = new DateDAO();

$idUsuario = $_SESSION["idUsuario"];

if(isset($_POST["vals"])){
    
    $ps = $cd->getMesCorrente($idUsuario);

    $mc = populaTabMensal($ps);

    $ps = $cd->getTotalMesCorrente($idUsuario);
    $tmc = totalMensal($ps);
    
    $ps = $cd->getTotalMesCorrenteIndividual($idUsuario);
    $tmci = totalMensal($ps);

    $ps = $cd->getAnoCorrente($idUsuario);
    $tyc = populaTabAnual($ps);

    $ps = $cd->getTotalAnoCorrente($idUsuario);
    $ttyc = totalAnual($ps);

    $ps = $cd->getTotalAnoCorrenteInd($idUsuario);
    $ttyci = totalAnual($ps);

    $ts = $cd->getSempre($idUsuario);

    $ps = $cd->getTotalSempreTotalEInd($idUsuario);
    $row = $ps->fetch(PDO::FETCH_OBJ);
    $tts = number_format($row->c_total, 2, ',', '.');
    $ttsi = number_format($row->c_total_ind, 2, ',', '.');
    
    $since =  $cd->getSince($idUsuario);

    echo json_encode([
        "ttm"=>$tmc,
        "tm"=>$mc,
        "sc"=>$since,
        "ttmi"=>$tmci,
        "ty"=>$tyc,
        "tty"=>$ttyc,
        "ttyi"=>$ttyci,
        "tf"=>$ts,
        "ttf"=>$tts, 
        "ttfi"=>$ttsi
    ]);

}

if(isset($_POST["dCorMensal"])){

    $ps = $cd->getMesCorrente($idUsuario);

    $mc = populaTabMensal($ps);

    $ps = $cd->getTotalMesCorrente($idUsuario);
    $tmc = totalMensal($ps);
    
    $ps = $cd->getTotalMesCorrenteIndividual($idUsuario);
    $tmci = totalMensal($ps);

    echo json_encode([
        "mc"=>$mc,
        "tmc"=>$tmc,
        "tmci"=>$tmci
    ]);

}

if(isset($_POST["dCorAnual"])){

    $ps = $cd->getAnoCorrente($idUsuario);

    $tabAnual = populaTabAnual($ps);

    $ps = $cd->getTotalAnoCorrente($idUsuario);

    $tty = totalAnual($ps);

    $ps = $cd->getTotalAnoCorrenteInd($idUsuario);

    $ttyi = totalAnual($ps);

    echo json_encode([
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

        $ps = $cd->getMesSearch($mr,$idUsuario);

        $ms = populaTabMensal($ps);
        $mes = $dd->dateSearch($m);

        $ps = $cd->getTotalMesRef($mr,$idUsuario);

        $tms = totalMensal($ps);

        $ps = $cd->getTotalMesRefInd($mr,$idUsuario);

        $tmsi = totalMensal($ps);

        echo json_encode([
            "m" => $mes,
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

        $ttys = totalAnual($cd->getTotalAnoRef($year,$idUsuario));

        $ttysi = totalAnual($cd->getTotalAnoRefInd($year,$idUsuario));

        echo json_encode([
            "ys"=>$ys,
            "ttys"=>$ttys,
            "ttysi"=>$ttysi
        ]);

    }

}

function populaTabMensal($st){
    $content = [];
    $mes = "";
    
    while($row = $st->fetch(PDO::FETCH_OBJ)){
        $mes = [
            "mes"=>$row->mes
        ];
        
        $array_temp =["<tr>",
                    "<td><i class='pe-7s-date'></i>&nbsp$row->dia</td>
                    <td class='vals'>".number_format($row->c_valor, 2, ',', '.')."</td>",
                    "<td class='vals'>".number_format($row->c_ind, 2, ',', '.')."</td>",
                    "<td class='vals'> <a href='../../app/Controller/comissaoDelete.php?id=$row->c_id'><i style='font-size:1.5em' class='pe-7s-trash'></i></a></td>",
                    "</tr>"    
                ]; 
                
        array_push($content,$array_temp);
    }

    array_push($content,$mes);

    return $content;
}

function populaTabAnual($st){
    
    $content = [];
    
    while($row = $st->fetch(PDO::FETCH_OBJ)){

        $mes = strtoupper(substr($row->mes,0,1)).substr($row->mes,1);

        $array_temp = [
                        "<tr>",
                        "<td><i class='pe-7s-date'></i>&nbsp<a href='mensal.php?ms=$row->ms'>$mes</a></td>",
                        "<td class='vals'>".number_format($row->total_mes, 2, ',', '.')."</td>",
                        "<td class='vals'>".number_format($row->total_ind, 2, ',', '.')."</td><td></td></tr>"
                    ];

        array_push($content, $array_temp);

    }

    return $content;

}

function totalMensal($st){
    $row = $st->fetch(PDO::FETCH_OBJ);
    return number_format($row->c_total_mes, 2, ',', '.');
}

function totalAnual($st){
    $row = $st->fetch(PDO::FETCH_OBJ);
    return number_format($row->c_total_ano, 2, ',', '.');
}

function imprimeArray($array){
    foreach($array as $linha){
        echo $linha;
    }
}