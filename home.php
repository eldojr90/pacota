<?php

session_start();
    
$title = "Home";
ob_start();
?>
<div class='row'>
    <div class='col-md-4'></div>
    
    <div class='col-md-4'>
        <div class='card' align="center">
            <a href="lancaComissao.php"><button class='btn btn-primary btn-block' align="center"><i class='pe-7s-note2'></i> Lançar comissão</button></a>
        </div>
    </div>

    <div class='col-md-4'></div>
</div>
<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title"><b>Mensal</b>&nbsp&nbsp&nbsp<span id="mesCorrente"></span></h4>
                <h4 class="title"><b>Total</b>&nbsp-&nbsp
                    <i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalMes"></span>
                </h4>
                <h4 class="title"><b>Indiv</b>&nbsp-&nbsp
                    <i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalMesInd"></span>
                </h4>
            </div>
            
            <div  class="content table-responsive table-full-width table-re">
                <table id="ms-div" class="table table-hover table-striped">
                    <thead>
                        <th>Dia</th>
                        <th class='vals'>Total R$
                        <th class='vals'>Individual R$</th>
                        <th></th>
                    </thead>
                    <tbody id="tabMensal">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><b>Anual</b>&nbsp&nbsp&nbsp<span id="anoCorrente"></span>
                <h4 class="title"><b>Total</b>&nbsp-&nbsp<i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalAno"></span></h4>
                <h4 class="title"><b>Indiv</b>&nbsp-&nbsp<i class="pe-7s-cash"></i>&nbspR$&nbsp<span class="spTotalAnoInd"></span></h4>
                
            </div>
            
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Mês</th>
                        <th class='vals'>Total R$
                        <th class='vals'>Individual R$</th>
                    </thead>
                    <tbody id="tabAnual">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><b>Geral</b>&nbsp&nbsp&nbsp<span id="since"></span>
                <h4 class="title"><b>Total</b>&nbsp-&nbsp<i class="pe-7s-cash">
                    </i>&nbspR$&nbsp<span class="spTotalSempre"></span>
                </h4>
                <h4 class="title">
                    <b>Indiv</b>&nbsp-&nbsp<i class="pe-7s-cash"></i>
                    &nbspR$&nbsp<span class="spTotalSempreInd"></span>
                </h4>
            </div>
            
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Ano</th>
                        <th class='vals'>Total R$
                        <th class='vals'>Individual R$</th>
                    </thead>
                    <tbody id="tabSemp">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="./assets/js/comissaoHome.js"></script>

<?php
$content = ob_get_contents();
ob_end_clean();

require_once 'master.php';