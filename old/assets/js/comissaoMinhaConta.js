var id = $("#idUsuario").val();
var controller = "app/Controller/usuarioUpdate.php";

$(document).ready(function(){

    verifyUsername();

    verifyEmail();

    verifyPassword();

    verifyPwdLength();

    verifyPwds();

    updateUser();

    ajustes();

});

function verifyUsername(){

    $("#username").focusout(function(){

        var us = $("#username").val();

        if(us != "" || us !== ""){

            $.ajax({
                url:controller,
                type:"POST",
                data:{
                    exUs:true,
                    idUsuario:id,
                    usname:us
                },
                success:function(result){

                    console.log(result);

                    if(result){
                        notificao("gleam","Esse nome de usuário já está sendo utilizado!","danger");
                        $("#username").focus().
                        select();
                    }else{
                        console.log("Username disponível!");
                    }

                },
                error:function(p1,p2,p3){
                    console.log(p1);
                    console.log(p2);
                    console.log(p3);
                }
            });

        }

    });


}

function verifyEmail(){

    $("#email").focusout(function(){

        var em = $("#email").val();

        if(em != "" || em !== ""){

            $.ajax({
                url:controller,
                type:"POST",
                data:{
                    exEm:true,
                    idUsuario:id,
                    email:em
                },
                success:function(result){

                    console.log(result);

                    if(result){
                        notificao("gleam","Este email já está sendo utilizado!","danger");
                        $("#email").focus().select();
                    }else{
                        console.log("Email disponível!");
                    }

                },
                error:function(p1,p2,p3){
                    console.log(p1);
                    console.log(p2);
                    console.log(p3);
                }
            });

        }

    });


}

function verifyPassword(){

    $("#pwd").focusout(function(){

        var pwd = $("#pwd").val().trim();

        if(pwd != "" || pwd !== ""){

            $.ajax({
                url:controller,
                type:"POST",
                data:{
                    vPw:true,
                    idUsuario:id,
                    pwd:pwd
                },
                success:function(result){

                    console.log(result);

                    if(!result){

                        notificao("gleam","Senha incorreta!","danger");
                        $("#pwd").focus()
                        .select();

                    }else{

                        console.log("Senha ok!");

                    }

                },
                error:function(p1,p2,p3){
                    console.log(p1);
                    console.log(p2);
                    console.log(p3);
                }
            });

        }else{
            $("#pwd").focus().select();
            notificao("gleam","Informe a sua senha atual!","danger");
        }
    });


}

function verifyPwdLength(){

    $("#pass").focusout(function(){

        pwd = $("#pass").val();

        if(pwd.length < 6 && pwd.length > 0){

            $("#pass").focus().select();

            notificao("gleam","A senha deverá conter no mínimo 6 caracteres!","danger");

        }

    });

}

function verifyPwds(){

    $("#pwdcf").focusout(function(){

        var pwd = $("#pass").val();
        var rpwd = $("#pwdcf").val();

        if((pwd != "" || pwd !== "")
        && (rpwd != "" || rpwd !== "")){

            if((pwd.length < 6 && pwd.length > 0)
            && (rpwd.length < 6 && rpwd.length > 0)){

                notificao("gleam","A senha deverá conter no mínimo 6 caracteres!","danger");

            }else{

                if(pwd === rpwd){

                    notificao("like2","Senhas coincidem.","success");

                }else{

                    notificao("gleam","Senhas não coincidem!","danger");
                    $("#pwdcf").focus().select();

                }

            }

        }

    });


}

function updateUser(){

    $("#faltUser").submit(function(){

        var usname = $("#username").val();
        var email = $("#email").val();
        var cpwd = $("#pwd").val();
        var npwd = $("#pass").val();
        var rpwd = $("#pwdcf").val();
        
        var dados = null;

        if($("#optYes").prop("checked")){

            dados = {
                upUs:true,
                idUsuario:id,
                usname:usname,
                email:email,
                cpwd:cpwd,
                npwd:npwd,
                rpwd:rpwd
            };

        }else{

            dados = {
                upUs:true,
                idUsuario:id,
                usname:usname,
                email:email,
                cpwd:cpwd
            };

        }    
        console.log(dados);

        $.ajax({
            url:controller,
            type:"POST",
            data:dados,
            success:function(result){
                console.log(result);

                var mensagem = "";

                switch(result){

                    case "-5":
                        mensagem = "Esse nome de usuário já está sendo utilizado!";
                        $("#username").focus().select();
                        break;
                    case "-4":
                        mensagem = "Esse email já está sendo utilizado";
                        $("#email").focus().select();
                        break;
                    case "-3":
                        mensagem = "Sua senha atual está incorreta!";
                        $("#pwd").focus().select();
                        break;
                    case "-2":
                        mensagem = "As senhas não coincidem!";
                        $("#pass").focus().select();
                        break;
                    case "-1":
                        mensagem = "A senha deverá conter no mínimo 6 caracteres!";
                        break;
                    case "0":
                        mensagem = "Erro ao alterar. Consultar Admin.";
                        break;
                    case "1":
                        mensagem = "Dados atualizados com sucesso!";
                        break;

                }

                if(result == "1"){

                    notificao("like2",mensagem,"success");
                    $("#pwd").val(null);
                    $("#pass").val(null);
                    $("#pwdcf").val(null);

                }else{

                    notificao("gleam",mensagem,"danger");

                }

            },
            error:function(p1,p2,p3){
                console.log(p1);
                console.log(p2);
                console.log(p3);
            }
        });

        return false;
    });

}

function ajustes(){

    $("#username").select();

    optNo();

    $("#txtYes").click(function(){
        
        optYes();

    });

    $("#optYes").change(function(){

        optYes();

    });

    $("#optNo").change(function(){

        optNo();

    });

    $("#txtNo").click(function(){
        
        optNo();

    });

    
}

function optYes(){

    $("#optYes").prop("checked",true);
    
    $(".alt-senha").removeClass("hidden");
    
    $("#pass").focus()
    .prop("required",true);
    
    $("#pwdc").prop("required",true);

}

function optNo(){

    $("#optNo").prop("checked",true);
    
    $(".alt-senha").addClass("hidden");

    $("#pass").prop("required",false);
    
    $("#pwdc").prop("required",false);

}