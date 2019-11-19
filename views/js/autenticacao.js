function getAutenticacao(){
    var autenticacao = null;
    $.ajax({
        url: '../controller/AutenticacaoController.php',
        type: 'GET',
        async: false,
        processData: false,
        contentType: false,

        success: function(result){
            autenticacao = JSON.parse(result);
        },
        error: function(xhr, status, error){
            autenticacao = {
                email: null,
                senha: null,
            };
        }
    });
    return autenticacao;
}

function estaLogado(){
    var autenticacao = getAutenticacao();
    return autenticacao.email && autenticacao.senha;
}

function redicionarSeNaoLogado(url){
    if ( ! estaLogado() )
        location.href = url;
}