$(document).ready(function(){

    validatePwds();

    rePassword();

});

function validatePwds(){

    $("#npwd").focusout(function(){
        
        var npwd = $("#npwd").val();
        var pl = npwd.length;

        if( pl > 0 && pl < 6 ){

            notificao("gleam","A sua nova senha deverá conter no mínimo 6 caracteres!","danger");
            $("#npwd").val(null);

        }

    });

    $("#cnpwd").focusout(function(){
        
        var p = $("#npwd").val();
        var pc = $("#cnpwd").val();

        if(!(p === pc)){

            notificao("key","As senhas não coincidem!","danger");

        }

    });

}

function rePassword(){

    $("#fracc").submit(function(){
        var token = $("#token").val();
        var npwd = $("#npwd").val();
        var cnpwd = $("#cnpwd").val();

        if(npwd == cnpwd){

            $.ajax({
                url:"app/Controller/usuarioUpdate.php",
                type:"POST",
                data:{
                    upAcc:true,
                    token:token,
                    npwd:npwd
                },
                success:function(result){
                    console.log(result);
                    if(result==1){
                        window.location = "home.php";
                    }
                },
                error:function(p1,p2,p3){
                    console.log(p1);
                    console.log(p2);
                    console.log(p3);
                }
            });
            
        }else{

            notificao("key","As senhas não coincidem!","danger");

        }
        
        return false;

    });


}

