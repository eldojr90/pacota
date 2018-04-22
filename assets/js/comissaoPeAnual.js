var relatorio = "app/Controller/geraRelatorio.php";

$(document).ready(function(){

    anosDisponiveis();

   $("#pesqAno").submit(function(){
        
        var ano = $("#ano").val()

        getDadosAno(ano);

        return false;
    });

    if($("#ys").val() != "" && $("#ys").val() != null && $("#ys").val().trim() != ""){

        var anoRef = $("#ys").val();

        getDadosAno(anoRef);

    }else{

        dadosCorrentes();

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

function dadosCorrentes(){
    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            dCorAnual:true
        },
        dataType:"json",
        success:function(result){
            $("#tabAnual").html(getTable(result.ty));
            $(".spTotalAno").html(result.tty);
            $(".spTotalAnoInd").html(result.ttyi);
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });

}

function getDadosAno(ano){
    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            dYSearch:true,
            year:ano
        },
        dataType:"json",
        success:function(result){
            $("#anoSrc").html(ano);
            $("#tabAnual").html(getTable(result.ys));
            $(".spTotalAno").html(result.ttys);
            $(".spTotalAnoInd").html(result.ttysi);
        }
    })


}