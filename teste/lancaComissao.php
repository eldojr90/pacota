<?php

session_start();

$title = "Comissão";

ob_start();

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Lança Comissão</h4>
            </div>
            <div class="content">
                <form id="fcomissao">
                    <div class="row">
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Data automática</label>
                                <br/>
                                <input id="rYes" name="data" type="radio" value="1"><spam id="txtYes">Sim</spam><br/>
                                
                                <input id="rNo" name="data" type="radio" value="0"><spam id="txtNo">Não</spam><br/>
                            </div>
                        </div>
                        
                        <div id="dt" class="col-md-2 cp-data">
                            <div class="form-group">
                                <label>Data</label>
                                <input id="data-text" type="text" class="form-control" 
                                    placeholder="Data" value="" readonly>
                            </div>
                        </div>

                        <div id="dd" class="col-md-2 cp-data">
                            <div class="form-group">
                                <label>Data</label>
                                <input id="data-date" type="date" class="form-control" 
                                    placeholder="Data" value="">
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>R$</label>
                                <input id="comissao" type="number" step="0.01" class="form-control" placeholder="Ex: 10.50" required autofocus>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Confirmar</label>
                                <input type="submit" class="btn btn-primary btn-block" value="Lançar comissão">
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div> 

<script src="./assets/js/comissaoInsert.js"></script>

<?php

$content = ob_get_contents();
ob_end_clean();

require_once 'master.php';