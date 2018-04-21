var relatorio = "app/Controller/geraRelatorio.php";
var atData = "app/Controller/atualizaDataHora.php";

$(document).ready(function(){

    anosDisponiveis();

    dadosCorrentes();

    $("#pesqMes").submit(function(){
        
        var mes = $("#mes").val();
        var ano = $("#ano").val()

        getDadosMesRef(mes,ano);

        return false;
    });

    $("#ano").change(function(){

        if($("#ano").val() !== ""){

            var ano = $("#ano").val();

            $("#mes").prop("disable",false);

            mesesDisponiveis(ano);

        }else{

            $("#mes").html("<option class='primeiro' value=''></option>");

        }

    });

    if($("#ms").val()!== "" && $("#ms").val() !== null && $("#ms").val().trim()!== "" ){

        var ms = $("#ms").val();
        
        var mes = ms.slice(0,2);
        var ano = ms.slice(3);

        getDadosMesRef(mes,ano);
        
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

function mesesDisponiveis(ano){
    
    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            monthsAvailable:true,
            year:ano
        },
        success:function(result){
            $("#mes").html(result);
        }
    });

}

function dadosCorrentes(){
    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            dCorMensal:true
        },
        dataType:"json",
        success:function(result){
            $("#tabMensal").html(getTable(result.mc));
            $(".spTotalMes").html(result.tmc);
            $(".spTotalMesInd").html(result.tmci);
            
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function getDadosMesRef(mes,ano){
    
    mesRef = mes + "/" + ano;

        $.ajax({
            url:relatorio,
            type:"POST",
            data:{
                tabMensalSrc:true,
                monthRef:mesRef,
                mes:mes
            },
            dataType:"json",
            success:function(result){
                $("#mesSrc").html(result.m.slice(0,3) + "/" + ano);
                $("#tabMensal").html(getTable(result.ms));
                $(".spTotalMes").html(result.tms);
                $(".spTotalMesInd").html(result.tmsi);
                
                
            }
        });

}