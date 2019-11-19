function onload(){
    if ( temAdicionarCarrinho() ){
        adicionarCarrinho();
    }
    construirCarrinho();
    habilitarBotaoConcluir();
}

function temAdicionarCarrinho(){
    var produtoId =  construirProdutoId();
    if ( produtoId == null || produtoId == undefined ){
        return false;
    } 
    return true;
}

function adicionarCarrinho(){
    var produtoId   = construirProdutoId();
    var carrinho    = getCarrinho();
    var produtos    = carrinho.produtos;
    var indice = -1;
    for ( var i = 0; i < produtos.length; i++ ){
        var produto = produtos[i];
        if ( produto.id == produtoId ){
            indice = i;
            break;
        }
    }
    if ( indice == -1 ){
        produtos.push({"id":produtoId, "quantidade":1});
    } else {
        produtos[indice].quantidade += 1;
    }
    salvarCarrinho(carrinho);
}

function construirProdutoId(){
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('produtoId');
}
 
function construirCarrinho(){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    var total      = 0.0;
    for( var i = 0; i < produtos.length; i++ ){
        var produto     = encontrarProduto(produtos[i].id);
        var quantidade  = produtos[i].quantidade;
        var divProduto  = construirDivProduto(produto, quantidade);
        adicionarDivProduto(divProduto);
        total           = total + produto.precoVenda * quantidade;
    }
    var divTotal = construirDivTotal(total.toFixed(2));
    adicionarDivTotal(divTotal);
}

function habilitarBotaoConcluir(){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    if ( produtos == null || produtos == undefined || produtos.length == 0 ){
        document.getElementById("linkFinalizarCompra").href = "#";
        $("#linkFinalizarCompra").addClass("disabled");
    }
}

function encontrarProduto(produtoId){
    var produto = null;
    $.ajax({
        url: '../controller/ProdutoController.php',
        type: 'GET',
        async: false,
        data: "id=" + produtoId,
        processData: false,
        contentType: false,

        success: function(result){
            produto = JSON.parse(result);
        },
        error: function(xhr, status, error){

        }
    });
    return produto;
}

function construirDivProduto(produto, quantidade){
    var id              = produto.id;
    var imagem          = '../database/images/' + produto.imagem;
    var nome            = produto.nome;
    var preco           = produto.precoVenda;
    var totalItem       = produto.precoVenda * quantidade;

    var linha1 = '<tr id="item-' + id + '">'; 
    var linha2 = '<td><img id="imagem-' + id + '" src="' + imagem + '" width="50px" height="50px" /></td>';
    var linha3 = '<td id="nome-' + id + '">' + nome + '</td>';
    var linha4 = '<td class="d-flex justify-content-around">';
    var linha5 = '<input id="quantidade-' + id + '" class="form-control col-md-3 text-right" type="number" value="' + quantidade + '" onchange=atualizarItem(' + id + ') />';
    var linha6 = '</td>';
    var linha7 = '<td id="preco-venda-' + id + '" class="text-center">' + preco + ' R$ <input id="preco-venda-hidden-' + id + '" type="hidden" value="' + preco + '" /></td>';
    var linha8 = '<td id="total-item-' + id + '" class="text-center">' + totalItem.toFixed(2) + ' R$<input id="total-item-hidden-' + id + '" class="total-item" type="hidden" value="'+ totalItem.toFixed(2) + '" /></td>';
    var linha9 = '<td class="text-center"><button class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="goToModal(' + id + ')"><i class="fa fa-trash"></i> </button> </td>';
    var linha10 = '</tr>';

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7 + linha8 + linha9 + linha10;
}

function goToModal(id){
    $("#modal-exclusao").modal();
    $("#btnConfirm").click(function(){
        excluirItem(id);
    });
}

function adicionarDivProduto(divProduto){
    $("tbody").append(divProduto);
}

function construirDivTotal(total){
    var part1 = '<tr><td></td><td></td><td></td><td td class="text-center"><strong>Total</strong></td><td class="text-center"><strong id="total">';
    var part2 = ' R$</strong></td><td></td></tr>';
    return part1 + total + part2;
}

function adicionarDivTotal(divTotal){
    $("tbody").append(divTotal);
}

function atualizarItem(id){
    var quantidade  = parseInt(document.getElementById("quantidade-" + id).value);
    var precoVenda  = parseFloat(document.getElementById("preco-venda-hidden-" + id).value);
    var totalItem   = precoVenda * quantidade;
    $("#total-item-" + id).text(totalItem + " R$");
    $("#total-item-hidden-" + id).val(totalItem);
    atualizarCarrinho(id, quantidade);
    atualizarTotal();
}

function excluirItem(id){
    removerCarrinho(id);
    $("#item-" + id).remove();
    atualizarTotal();
}

function atualizarTotal(){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    var total = 0.0;
    for( var i=0; i < produtos.length; i++){
        var produto = encontrarProduto(produtos[i].id);
        total += produto.precoVenda * produtos[i].quantidade;
    }
    $("#total").text(total.toFixed(2) + " R$");
}