<?php

session_start();

$title = "Anual";
ob_start();
?>

<input type="text" id="ys" value="<?php if(isset($_GET["ys"])){ echo $_GET["ys"]; }?>" hidden>

<div class="row">

    <form id="pesqAno" method="POST">
        
    <div class="col-sm-2">
            <div class="form-group">
                <select class="form-control" name="ano" id="ano">
                </select>
            </div>    
        </div> 

        <div class="col-sm-2">
            <input id="teste" class="btn btn-primary" type="submit" value="Buscar">
        </div>

    </form>

</div>

<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title"><b><spam id="anoSrc"></spam></b></h4>
                <h4 class="title"><b>Total</b>
                &nbsp-&nbsp<i class="pe-7s-cash"></i>&nbspR$&nbsp<spam class="spTotalAno"></spam></h4>
                <h4 class="title"><b>Indiv</b>
                &nbsp-&nbsp<i class="pe-7s-cash"></i>&nbspR$&nbsp<spam class="spTotalAnoInd"></spam></h4>
                
            </div>
            
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Mês</th>
                        <th class="vals">Total R$</th>
                        <th class="vals">Individual R$</th>
                    </thead>
                    <tbody id="tabAnual">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="./assets/js/comissaoPeAnual.js" ></script>

<?php
$content = ob_get_contents();
ob_end_clean();

require_once 'master.php';