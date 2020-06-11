<?php

session_start();

$title = "Mensal";
ob_start();
?>
<div class="row">

    <input type="text" id="ms" value="<?php if(isset($_GET["ms"])){ echo $_GET["ms"]; } ?>" hidden>

    <form id="pesqMes" method="POST">
        
        <div class="col-sm-2">
            <div class="form-group">
                <select class="form-control" name="ano" id="ano">
                </select>
            </div>    
        </div> 

        <div class="col-sm-2">
            
            <div class="form-group">
                
                <select class="form-control" name="mes" id="mes" required="required">
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
                <h4 class="title"><b><span id="mesSrc"></span></b>
                <h4 class="title">
                    <b>Total</b>&nbsp-&nbsp
                    <i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalMes"></span>
                </h4>
                <h4 class="title"><b>Indiv</b>&nbsp-&nbsp
                    <i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalMesInd"></span>
                </h4>
            </div>
            
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Dia</th>
                        <th class="vals">Total R$</th>
                        <th class="vals">Individual R$</th>
                        <th></th>
                    </thead>
                    <tbody id="tabMensal">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="./assets/js/comissaoPeMensal.js" ></script>

<?php
$content = ob_get_contents();
ob_end_clean();

require_once 'master.php';