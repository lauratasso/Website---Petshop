function onload(){
    showPedidos();
}

function showPedidos(){
    var pedidos = getPedidos();
    for ( var i = 0; i < pedidos.length; i++){
        var pedido = pedidos[i];
        var divPedido = construirDivPedido(pedido);
        adicionarDivPedido(divPedido);
    }
}

function getPedidos(){
    var pedidos = null;
    $.ajax({
        url: '../../controller/PedidoController.php',
        type: 'GET',
        async: false,
        processData: false,
        contentType: false,

        success: function(result){
            pedidos = JSON.parse(result);
        },
        error: function(xhr, status, error){

        }
    });
    return pedidos;
}

function construirDivPedido(pedido){
    var quantidadeItems = construirQuantidadeItems(pedido);
    var nomeCliente = construirNomeCliente(pedido);
    var linha1 = '<tr>';
    var linha2 = '<td></td>';
    var linha3 = '<td class="text-center">' + pedido.id + '</td>';
    var linha4 = '<td class="text-center">' + pedido.data + '</td>';
    var linha5 = '<td class="text-center">' +  quantidadeItems + '</td>';
    var linha6 = '<td class="text-center">' + pedido.total.toFixed(2) + ' R$</td>';
    var linha7 = '<td class="text-center">'  + pedido.formaPagamento + '</td>';
    var linha8 = '<td class="text-center">' + nomeCliente + '</td>';
    var linha9 = '<td class="text-center">';
    var linha10 = '<a href="order-details.php?idPedido=' + pedido.id +  '" class="btn btn-sm btn-outline-primary" >';
    var linha11 = '<i class="fa fa-shopping-cart"></i>';
    var linha12 = '</a>';
    var linha13 = '</td>';
    var linha14 = '</tr>';

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7 + linha8 + linha9 + linha10 + linha11 + linha12 + linha13 + linha14;

}

function adicionarDivPedido(divPedido){
    $("tbody").append(divPedido);
}

function construirQuantidadeItems(pedido){
    var quantidadeItems = 0;
    var parametros = new FormData();
    parametros.append("idPedido", pedido.id);
    $.ajax({
        url: '../../controller/ItemController.php',
        type: 'GET',
        async: false,
        data: parametros,
        processData: false,
        contentType: false,

        success: function(result){
            var items = JSON.parse(result);
            quantidadeItems = items.length;
        },
        error: function(xhr, status, error){
            quantidadeItems = 0;
        }
    });
    return quantidadeItems;
}

function construirNomeCliente(pedido){
    var nomeCliente = "";
    var parametros = new FormData();
    parametros.append("id", pedido.idUsuario);
    $.ajax({
        url: '../../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        data: parametros,
        processData: false,
        contentType: false,

        success: function(result){
            nomeCliente = JSON.parse(result)[0].nome;
        },
        error: function(xhr, status, error){
            nomeCliente = "";
        }
    });
    return nomeCliente;
}