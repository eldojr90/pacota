<?php

require_once '../../vendor/autoload.php';

use App\Model\DAO\ComissaoDAO;

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $cd = new ComissaoDAO();
    
    $comissao = $cd->getComissao($id);
    
    session_start();
    
    $_SESSION["comissao"] = serialize($comissao);
    
    header("location: ../pages/conteudo/edita_comissao.php");
    
}
