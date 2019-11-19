function onload(){
    buscarProdutos();
}

function buscarProdutos(){
    var produtos = buscarProdutoRecentes();
    show(produtos);
}

function buscarProdutoRecentes(){
    var produtos = null;
    $.ajax({
        url: '../controller/ProdutoController.php',
        type: 'GET',
        async: false,
        data: "recentes=recentes",
        processData: false,
        contentType: false,

        success: function(result){
            produtos = JSON.parse(result);
        },
        error: function(xhr, status, error){

        }
    });
    return produtos;
}

function show(produtos){
    showNovidades(produtos);
    showProdutos(produtos);
}

function showNovidades(produtos){
    for ( var i = 0; i < 3 && i < produtos.length; i++){
        var produto = produtos[i];
        var divProduto = construirDivProduto(produto);
        $("#new-row").append(divProduto);
    }
}

function showProdutos(produtos){
    var divProducts = $("#products");
    var row = 0;
    var divRow = null;
    for (var i = 3; i < produtos.length; i++ ){
        if ( i % 3 == 0 ){
            divProducts.append('<div id="row-' + row + '" class="row"></div><br>');
            divRow = $("#row-" + row);
            row++;
        }
        var produto = produtos[i];
        divRow.append(construirDivProduto(produto));
    }
    divProducts.append("<hr/>");
}

function construirDivProduto(produto){
    var linha1 = '<div class="col-12 col-md-6 col-lg-4">';
    var linha2 = '<div class="card">';
    var linha3 = '<img class="card-img-top" src="../database/images/' + produto.imagem + '" width="600px" height="400px" alt="Card image cap">';
    var linha4 = '<div class="card-body">'
    var linha5 = '<h4 class="card-title">' + produto.nome + '</h4>';
    var linha6 = '<p class="card-text">' + produto.descricao + '</p>';
    var linha7 = '<div class="row">';
    var linha8 = '<div class="col">';
    var linha9 = '<p class="btn btn-info btn-block">R$' + produto.precoVenda + '</p>'
    var linha10 = '</div>';
    var linha11 = '<div class="col">'
    var linha12 = '<a href="cart.php?produtoId=' + produto.id + '" class="btn btn-success btn-block">Adicionar ao carrinho</a>';
    var linha13 = '</div>';
    var linha14 = '</div>';
    var linha15 = '</div>';
    var linha16 = '</div>';
    var linha17 = '</div>';
    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7 + linha8 + linha9 + linha10 + linha11 + linha12 + linha13 + linha14 + linha15;
}