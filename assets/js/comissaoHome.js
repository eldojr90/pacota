$(document).ready(function(){
    
    mesCorrente();
    atualizaMesCorrente();

    anoCorrente();
    atualizaAnoCorrente();

    since();
    
    extratoMensal();
    atualizaExtratoMensal();
    
    saldoMensal();
    atualizaSaldoMensal();

    saldoMensalInd();
    atualizaSaldoMensalInd();
    
    extratoAnual();
    atualizaExtratoAnual();

    saldoAnual();
    atualizaSaldoAnual();

    saldoAnualInd();
    atualizaSaldoAnualInd();

    extratoSempre();
    atualizaExtratoSempre();

    saldoSempre();
    atualizaSaldoSempre();

    saldoSempreInd();
    atualizaSaldoSempreInd();

});

function mesCorrente(){
        $.ajax({
            url:"app/Controller/atualizaDataHora.php",
            type:"POST",
            data:{formato:"%b/%Y"},
            success:function(result){
                $("#mesCorrente").html(result);
                
            },
            error:function(p1,p2,p3){
                console.log(p1);
                console.log(p2);
                console.log(p3);
            }
        });
}

function atualizaMesCorrente(){
    setInterval("mesCorrente()",5000);
}

function anoCorrente(){
    $.ajax({
        url:"app/Controller/atualizaDataHora.php",
        type:"POST",
        data:{formato:"%Y"},
        success:function(result){
            $("#anoCorrente").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function since(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{
            since:true
        },
        success:function(result){
            $("#since").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaAnoCorrente(){
    setInterval("anoCorrente()",5000);
}

function extratoMensal(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{tabMensal:true},
        success:function(result){
            
            $("#tabMensal").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaExtratoMensal(){
    setInterval("extratoMensal()",4000);
}

function saldoMensal(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalMensal:true},
        success:function(result){
            $(".spTotalMes").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoMensal(){
    setInterval("saldoMensal()",4000);
}

function saldoMensalInd(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalMensalInd:true},
        success:function(result){
            $(".spTotalMesInd").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoMensalInd(){
    setInterval("saldoMensalInd()",4000);
}

function extratoAnual(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{tabAnual:true},
        success:function(result){
            
            $("#tabAnual").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaExtratoAnual(){
    setInterval("extratoAnual()",4000);
}

function saldoAnual(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalAnual:true},
        success:function(result){
            
            $(".spTotalAno").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoAnual(){
    setInterval("saldoAnual()",4000);
}

function saldoAnualInd(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalAnualInd:true},
        success:function(result){
            
            $(".spTotalAnoInd").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoAnualInd(){
    setInterval("saldoAnualInd()",4000);
}

function extratoSempre(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{tabSemp:true},
        success:function(result){
            
            $("#tabSemp").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaExtratoSempre(){
    setInterval("extratoSempre()",4000);
}

function saldoSempre(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalSemp:true},
        success:function(result){
            
            $(".spTotalSempre").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoSempre(){
    setInterval("saldoSempre()",4000);
}

function saldoSempreInd(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalSempInd:true},
        success:function(result){
            
            $(".spTotalSempreInd").html(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function atualizaSaldoSempreInd(){
    setInterval("saldoSempreInd()",4000);
}