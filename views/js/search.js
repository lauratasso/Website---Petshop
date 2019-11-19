function onload(){
    if ( existeConsulta() ){
        alterarTitulo();
        buscarProdutoPorDescricao();
    } else {

    } 
}

function buscarProdutoPorDescricao(){
    var descricao = buildDescricaoProduto();
    $.ajax({
        url: '../controller/ProdutoController.php',
        type: 'GET',
        async: false,
        data: "descricao=" + descricao,
        processData: false,
        contentType: false,

        success: function(result){
            var produtos = JSON.parse(result);
            showProdutos(produtos);
        },
        error: function(xhr, status, error){

        }
    });
}

function alterarTitulo(){
    var descricao = buildDescricaoProduto();
    document.getElementById("titulo").innerHTML = 'Resultado da busca "' + descricao + '"';
}

function existeConsulta(){
    var urlParams = new URLSearchParams(window.location.search);
    var consulta =  urlParams.get('consulta');
    if ( consulta == null || consulta == undefined ){
        return false;
    }
    return true;
}

function buildDescricaoProduto(){
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('consulta').toLowerCase();
}

function showProdutos(produtos){
    var divSearch = $("#search");
    var row = 0;
    var divRow = null;
    for (var i = 0; i < produtos.length; i++ ){
        if ( i % 3 == 0 ){
            divSearch.append('<div id="row-' + row + '" class="row"></div><br>');
            divRow = $("#row-" + row);
            row++;
        }
        var produto = produtos[i];
        divRow.append(buildDivProduto(produto));
    }
    divSearch.append("<hr/>");
}

function buildDivProduto(produto){
    var part1       = '<div class="col-12 col-md-6 col-lg-4"><div class="card"><img class="card-img-top" src="../database/images/';
    var imagem      = produto.imagem;
    var part2       ='" width="600px" height="400px" alt="Card image cap"><div class="card-body"> <h4 class="card-title">';
    var nome        = produto.nome;
    var part3       = '</h4><p class="card-text">';
    var descricao   = produto.descricao;
    var part4       = '</p><div class="row"><div class="col"><p class="btn btn-info btn-block">R$ ';
    var preco       = produto.precoVenda;
    var part5       = ' </p></div><div class="col"><a href="cart.php?produtoId=' 
    var id          = produto.id;
    var part6       = '" class="btn btn-success btn-block">Adicionar ao carrinho</a></div></div></div></div></div>'
    return part1 + imagem + part2 + nome + part3 + descricao + part4 + preco + part5  + id + part6;
}