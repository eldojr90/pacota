$(document).ready(function(){
    
getValues();

});

function getValues(){
    $.ajax({
        url:"app/Controller/geraRelatorio.php",
        type:"POST",
        data:{
            vals:true
        },
        dataType:"json",
        success:function(result){

            $("#since").html(result.sc);
            $("#tabMensal").html(getTable(result.tm));
            $(".spTotalMes").html(result.ttm);
            $(".spTotalMesInd").html(result.ttmi);
            $("#tabAnual").html(getTable(result.ty));
            $(".spTotalAno").html(result.tty);
            $(".spTotalAnoInd").html(result.ttyi);
            $("#tabSemp").html(getTable(result.tf));
            $(".spTotalSempre").html(result.ttf);
            $(".spTotalSempreInd").html(result.ttfi);

        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

