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

            var countMes = Object.keys(result.tm).length;

            if(countMes > 0){

                var mes = result.m.slice(0,3)+"/"+result.y;

                //último mês
                $("#mesCorrente").html(mes);
                $("#tabMensal").html(getTable(result.tm));
                $(".spTotalMes").html(result.ttm);
                $(".spTotalMesInd").html(result.ttmi);
            
                //último ano
                $("#anoCorrente").html(result.y);
                $("#tabAnual").html(getTable(result.ty));
                $(".spTotalAno").html(result.tty);
                $(".spTotalAnoInd").html(result.ttyi);
            
                //sempre
                $("#since").html(result.sc);
                $("#tabSemp").html(getTable(result.tf));
                $(".spTotalSempre").html(result.ttf);
                $(".spTotalSempreInd").html(result.ttfi);

            }

        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });

}

