$(document).ready(function(){

    getNomeUsuario();
   
});

function getNomeUsuario(){
    
    var idUsuario = $("#idUsuario").val();
    
    if(idUsuario !== ""){
        $.ajax({
           url:"app/Controller/usuarioSearch.php",
           type:"POST",
           data:{
               nomeUs:true,
               idUsuario:idUsuario
           },
           success: function(result){
               $("#nomeUsuario").html(result);
           },
           error: function(p1,p2,p3){
               console.log(p1);
               console.log(p2);
               console.log(p3);
           }
        });
    
    }else{
    
        console.log("Id usuário vazia.");
        
    }    
    
}