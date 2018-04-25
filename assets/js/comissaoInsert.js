$(document).ready(function(){

    $("#fcomissao").submit(function(){
        
        var valor = $("#comissao").val();
        var date = $("#data-date").val();

        if($("#rYes").prop("checked")){

            dados = {
                valor:valor
            }

        }else if($("#rNo").prop("checked")){

            dados = {
                valor:valor,
                date:date
            }


        }    

        $.ajax({
            url:"app/Controller/comissaoInsert.php",
            type:"POST",
            data:dados,
            success:function(retorno){
                
                var mensagem = "";
                
                switch(retorno){
                    case "-2":
                        mensagem = "Somente é permitido informar datas de 2000 até a atual.";
                        break;
                    case "-1":
                        mensagem = "Já existe comissão cadastrada com essa data!";
                        break;
                    case "0":
                        mensagem = "Erro ao cadastrar comissão!";    
                        break;
                    case "1":
                        mensagem = "Comissão cadastrada com sucesso!";
                        break;
                    default:
                        mensagem = "Consulte elisa-master.js";
                        break;    
                }

                var icone = (retorno !== "1")?'pe-7s-gleam':'pe-7s-like2';
                var tipo = (retorno !== "1")?"danger":"success";
                
                notificao(icone,mensagem,tipo);
                
                $("#fcomissao").each(function(){
                    this.reset();
                    ajustes();
                });
            },
            error:function(par1, par2, par3){
                console.log(par1);
                console.log(par2);
                console.log(par3);
            }
        });

        return false;
    });
    
    ajustes();

    $("#data-date").change(function(){
    
        validaData();

    });

    $("#comissao").focusin(function(){

        validaData();

    });

});

function ajustes(){

    optYes();

    $("#rYes").click(function(){
        if(!$("#rYes").prop("disabled")){
            optYes();
        }else{
            comissaoExistente("danger");
        }    
    });

    $("#rNo").click(function(){
        optNo(true);
    });

    $("#txtYes").click(function(){
        if(!$("#rYes").prop("disabled")){
            optYes();
        }else{
            comissaoExistente("danger");
        }    
    });

    $("#txtNo").click(function(){
        optNo(true);
    });

    verificaData();

}

function optYes(){

    $("#rYes").prop("checked",true);
    
    $("#dt").css("display","block")
    .prop("required",true);
    
    $("#dd").css("display","none")
    .prop("required",false);

    $("data-date").val(null);
    
    $("#comissao").focus();

    verificaData();

}

function optNo(bl){
    
    $("#rNo").prop("checked",true);
    
    $("#dt").css("display","none").prop("required",false);
    
    $("#dd").css("display","block").prop("required",true);
    
    $("#data-date").focus();

    if(bl){notificao("info","Informe a data","info")};

}

function blockYes(){
    
    $("#rYes").prop("disabled",true);

}

function comissaoExistente(tipo){
    
    $.notify({
        icon: "pe-7s-"+(tipo=='info' || tipo == 'warning'?"info":"gleam"),
        message: "Opção indisponível."
    },
    {
        type: tipo,
        timer: 500,
        placement: {
            from: 'top',
            align: 'center'
        }
    });

}

function verificaData(){

    $.ajax({
        url:"app/Controller/comissaoInsert.php",
        type:"POST",
        data:{
            lastDate:true
        },
        success:function(result){

            if(result == 0){

                optNo(false);
                blockYes();

            }else{
                
                $("#data-text").attr("value",result);
                

            }
        },
        error:function(p1,p2,p3){
            console.log(p1);
            console.log(p2);
            console.log(p3);
        }
    });

}
    
function validaData(){
    
    var dd = $("#data-date").val();

    if(!$("#rYes").prop("checked") && dd.length > 0){

        $.ajax({
            
            url:"app/Controller/comissaoInsert.php",
            type:"POST",
            data:{
                validaData:true,
                dd:dd
            },
            success:function(result){
                
                if(result){
                    
                    notificao("gleam","Já existe comissão com a data informada!","danger");
                    $("#data-date").focus();

                }

            },
            error:function(p1,p2,p3){
                console.log(p1);
                console.log(p2);
                console.log(p3);
            }

        });
    }
}