var relatorio = "app/Controller/geraRelatorio.php";
var atData = "app/Controller/atualizaDataHora.php"

$(document).ready(function(){

    anosDisponiveis();

    extratoMensal();

    mesCorrente();

    saldoMensal();

    saldoMensalInd();

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

function extratoMensal(){
    $.ajax({
        url:relatorio,
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

function saldoMensal(){
    $.ajax({
        url:relatorio,
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

function saldoMensalInd(){
    $.ajax({
        url:relatorio,
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

function mesCorrente(){
    $.ajax({
        url:atData,
        type:"POST",
        data:{formato:"%B/%Y"},
        success:function(result){
            $("#mesSrc").html('<b>'+result.charAt(0).toUpperCase()+
                                result.slice(1)+
                                '</b>&nbsp-&nbsp<i class="pe-7s-cash"></i>&nbspR$ <span class="spTotalMes"></span>');
            
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });
}

function retornaMesExt(mes,ano){

    $.ajax({
        url:atData,
        type:"POST",
        data:{
            mesNum:mes
        },
        success:function(result){
            
            var view = result.charAt(0).toUpperCase() + result.slice(1) + "/" + ano;

            $("#mesSrc").html(  '<b>'+view+
                                '</b>&nbsp-&nbsp<i class="pe-7s-cash"></i>&nbsp'+
                                'R$ <span class="spTotalMes"></span>');
            
        }
    });

}

function totalMesRef(mesRef){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            totalMonthRef:true,
            monthRef:mesRef
        },
        success:function(result){
            $(".spTotalMes").html(result);
            console.log(result);
        }

    });

}

function totalMesRefInd(mesRef){

    $.ajax({
        url:relatorio,
        type:"POST",
        data:{
            totalMonthRefInd:true,
            monthRef:mesRef
        },
        success:function(result){
            $(".spTotalMesInd").html(result);
            console.log(result);
        }

    });

}

function getDadosMesRef(mes,ano){
    
    mesRef = mes + "/" + ano;

        console.log(mesRef);

        $.ajax({
            url:relatorio,
            type:"POST",
            data:{
                tabMensalSrc:true,
                monthRef:mesRef
            },
            success:function(result){
                
              if(result != ""){
                $("#tabMensal").html(result);
                console.log(result);
                retornaMesExt(mes,ano);
                totalMesRef(mesRef);
                totalMesRefInd(mesRef);
              }    
            
            }
        });

}