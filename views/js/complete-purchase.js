function onload(){
    redicionarSeNaoLogado('login.php');
    habilitarBotaoConcluir();
    construirCarrinho();
    construirEnderecoEntrega();
}

function construirCarrinho(){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    var total = 0.0;
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

function construirEnderecoEntrega(){
    var autenticacao = getAutenticacao();
    $.ajax({
        url: '../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        data: "email=" + autenticacao.email + "&=senha" + autenticacao.senha,
        processData: false,
        contentType: false,

        success: function(result){
            var usuario = JSON.parse(result)[0];
            document.getElementById('cep').innerHTML            = usuario.cepEntrega;
            document.getElementById('lougradouro').innerHTML    = usuario.lougradouroEntrega;
            document.getElementById('numero').innerHTML         = usuario.numeroEntrega;
            document.getElementById('bairro').innerHTML         = usuario.bairroEntrega;
            document.getElementById('cidade').innerHTML         = usuario.cidadeEntrega;
            document.getElementById('estado').innerHTML         = usuario.estadoEntrega;
        },
        error: function(xhr, status, error){

        }
    });
}

function habilitarBotaoConcluir(){
    var carrinho = getCarrinho();
    var produtos = carrinho["produtos"];
    if ( produtos == null || produtos == undefined || produtos.length == 0 ){
        $("#concluirCartaoCredito").prop("disabled",true);
        $("#concluirBoletoBancario").prop("disabled",true);
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
    $("#total-item-" + id).text(totalItem.toFixed(2) + " R$");
    $("#total-item-hidden-" + id).val(totalItem.toFixed(2));
    atualizarCarrinho(id, quantidade);
    atualizarTotal();
    habilitarBotaoConcluir();
}

function excluirItem(id){
    removerCarrinho(id);
    $("#item-" + id).remove();
    atualizarTotal();
    habilitarBotaoConcluir();
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

function concluirCartao(){
    var formData = construirConluirCartao();
    $.ajax({
        url: '../controller/PedidoController.php',
        type: 'POST',
        async: true,
        data: formData,
        contentType: 'application/json',

        success: function(result){
            if ( result.substring(0,6) == "CRIADO" ){
                limparCarrinho();
                habilitarBotaoConcluir();
                $("#successMessage").stop().fadeIn(200).delay(5000).fadeOut(200);
                document.getElementById("concluirCartaoCredito").disabled = true;
                window.scrollTo(0, 0);
            }
        },
        error: function(xhr, status, error){
            document.getElementById("message").innerHTML = status + error + xhr.responseText;
            $("#errorMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
            window.scrollTo(0, 0);
        }
    });
}

function concluirBoleto(){
    var formData = construirConluirBoleto();
    $.ajax({
        url: '../controller/PedidoController.php',
        type: 'POST',
        async: false,
        data: formData,
        contentType: 'application/json',

        success: function(result){
            if ( result.substring(0,6) == "CRIADO" ){
                limparCarrinho();
                habilitarBotaoConcluir();
                $("#successMessage").stop().fadeIn(200).delay(5000).fadeOut(200);
                document.getElementById("concluirBoletoBancario").disabled = true;
                window.scrollTo(0, 0);
                
            }
        },
        error: function(xhr, status, error){
            document.getElementById("message").innerHTML = status + error + xhr.responseText;
            $("#errorMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
            window.scrollTo(0, 0);

        }
    });

}

function construirConluirCartao(){
    var data = {};
    data["items"] = getCarrinho();
    data["formaPagamento"] = "Cartao de Credito";
    data["acao"] = "criar";
    return JSON.stringify(data);
 }

function construirConluirBoleto(){
    var data = {};
    data["items"] = getCarrinho();
    data["formaPagamento"] = "Boleto Bancario";
    data["acao"] = "criar";
    return JSON.stringify(data);
 }