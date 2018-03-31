$(document).ready(function(){
    
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
                      $("#retlogin").html("Login ok!");
                      window.location = "home.php";
                      
                  }else{
                      console.log("login não autorizado!");
                      $("#retlogin").html("Usuário/Senha inválidos!");
                      
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
 
});