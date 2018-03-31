var relatorio = "app/Controller/geraRelatorio.php";
var atData = "app/Controller/atualizaDataHora.php"

$(document).ready(function(){

    anosDisponiveis();

    extratoAnual();

    saldoAnual();
    saldoAnualInd();

    $("#pesqAno").submit(function(){
        
        var ano = $("#ano").val()

        getDadosAno(ano);

        return false;
    });

    if($("#ys").val() != "" && $("#ys").val() != null && $("#ys").val().trim() != ""){

        var anoRef = $("#ys").val();

        getDadosAno(anoRef);

    }

});

function anosDisponiveis(){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            yearsAvailable:true
        },
        success:function(result){
            $("#ano").html(result);
        }
    });

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

function saldoAnualInd(){

    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{totalAnualInd:true},
        success:function(result){
            $(".spTotalAnoInd").html(result);
            console.log(result);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });

}

function totalAnualSrc(ano){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            totalAnualSrc:true,
            year:ano
        },
        success:function(result){
            $(".spTotalAno").html(result);
        }
    });

}

function totalAnualSrcInd(ano){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            totalAnualSrcInd:true,
            year:ano
        },
        success:function(result){
            $(".spTotalAnoInd").html(result);
        }
    });

}


function getDadosAno(anoRef){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            tabAnualSrc:true,
            year:anoRef
        },
        success:function(result){

            $("#tabAnual").html(result);
            $("#anoSrc").html(anoRef);
            totalAnualSrc(anoRef);
            totalAnualSrcInd(anoRef);
            
        }
    });


}