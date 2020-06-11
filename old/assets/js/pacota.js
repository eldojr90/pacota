function notificao(icone,mensagem,tipo){
    $.notify({
        icon: "pe-7s-"+icone,
        message: mensagem
    },
    {
        type: tipo,
        timer: 200,
        placement: {
            from: 'top',
            align: 'center'
        }
    });
}

function ntErro(mensagem){
    notificao("gleam",mensagem,"danger");
}

function getTable(array){

    return (JSON.stringify(array));

}
