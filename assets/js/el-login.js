$(document).ready(function(){
    
    login();

    restoreAccount();

    verififyUsernameOrEmail();

    ajustes();
});

function login(){
    $("#flogin").submit(function(){
        console.log("submit ok!");
        var us_login = $("#usuario").val();
        var us_senha = $("#pwd").val();
        console.log("login: "+us_login);
        console.log("senha: "+us_senha);
        
        $.ajax({
                url:"app/Controller/validaLogin.php",
                type: 'POST',
                data:{
                    login:us_login,
                    senha:us_senha
                },
                success: function(retorno){
                  console.log("retorno: "+retorno);  
                  if(retorno == "1"){
                      console.log("login autorizado!");
                      
                      notificao("like2","Login ok!","success");
                      notificao("hourglass","Redirecionando...","info");

                      window.location = "home.php";
                      
                  }else{
                      console.log("login não autorizado!");
                      
                      notificao("key","Usuário/Senha inválidos!","danger");
                      
                  } 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                  console.log(jqXHR);
                  console.log(textStatus);
                  console.log(errorThrown);
            }
        });
        return false;
    });
 
}

function restoreAccount(){

    $("#frSenha").submit(function(){
        
        var usemail = $("#us-email").val();

        $.ajax({
            url:"app/Controller/usuarioUpdate.php",
            type:"POST",
            data:{
                rAcc:true,
                usemail:usemail
            },
            beforeSend:function(){
                notificao("hourglass","Aguarde...","info");
            },
            success:function(result){
                console.log(result);

                if(result != "-1" || result != -1){

                    if(!result){

                        notificao("gleam","Erro interno ao enviar email","danger");
                        
                    }else{
                        
                        notificao("mail","Confira seu email "+result+" e recupere sua conta!","success");    

                    }

                }else{

                    notificao("gleam","Não existe conta para o email/usuário informado!","danger");

                }

            }
        });
        
        return false;
    });

}

function verififyUsernameOrEmail(){

    $("#us-email").focusout(function(){

        var usemail = $("#us-email").val();

        if(usemail != "" || usemail !== ""){

            $.ajax({
                url:"app/Controller/usuarioSearch.php",
                type:"POST",
                data:{
                    usemail:usemail
                },
                success:function(result){

                    console.log(result);

                    if(!result){
                        $("#us-email").focus().select();
                        notificao("gleam","Usuário ou email não cadastrado!","danger");
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

function ajustes(){

    

    $("a").click(function(e){

        $("#dp").addClass("hidden");
        $("#rc").removeClass("hidden").fadeIn({
            duration:4000
        });
        
        notificao("info","Informe seu usuário ou email.","info");

        $("#us-email").focus();
        
        e.preventDefault();

        return false;
    });

}