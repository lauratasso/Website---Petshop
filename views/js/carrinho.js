function getCarrinho(){
    var stringCarrinho = window.localStorage.getItem("carrinho");
    if ( stringCarrinho == null || stringCarrinho == undefined ){
        var carrinho = {
            produtos: []
        };
        window.localStorage.setItem("carrinho", JSON.stringify(carrinho));
    }
    return JSON.parse(stringCarrinho);
}
 
function salvarCarrinho(carrinho){
    window.localStorage.setItem("carrinho", JSON.stringify(carrinho));
}

function removerCarrinho(produtoId){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    carrinho["produtos"] = produtos.filter(function(produto){
        return produto.id != produtoId;
    });
    salvarCarrinho(carrinho);
}

function atualizarCarrinho(produtoId, quantidade){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    for( var i=0; i < produtos.length; i++){
        if ( produtos[i].id == produtoId ){
            produtos[i].quantidade = quantidade;
            break;
        }
    }
    salvarCarrinho(carrinho);
}

function limparCarrinho(){
    var carrinho = {
        produtos:[]
    };
    window.localStorage.setItem("carrinho", JSON.stringify(carrinho));
}