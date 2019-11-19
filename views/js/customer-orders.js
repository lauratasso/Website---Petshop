function onload(){
    redicionarSeNaoLogado('login.php');
    construirTabelaPedido();
}

function construirTabelaPedido(){
    var pedidos = getPedidos();
    for ( var i=0; i < pedidos.length; i++ ){
        var pedido = pedidos[i];
        var divPedido = construirDivPedido(pedido);
        adicionarDivPedido(divPedido);
    }
}

function getPedidos(){
    var pedidos = null;
    var usuario = getUsuario();
    $.ajax({
        url: '../controller/PedidoController.php',
        type: 'GET',
        async: false,
        data: 'idUsuario=' + usuario.id,
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

function getUsuario(){
    var autenticacao = getAutenticacao();
    var usuario = null;
    $.ajax({
        url: '../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        data: 'email=' + autenticacao.email + '&senha=' + autenticacao.senha,
        processData: false,
        contentType: false,

        success: function(result){
            usuario = JSON.parse(result); 
        },
        error: function(xhr, status, error){

        }
    });
    return usuario;
}

function construirDivPedido(pedido){
    var linha1 = '<tr>';
    var linha2 = '<td></td>';
    var linha3 = '<td class="text-center">' + pedido.id + '</td>';
    var linha4 = '<td class="text-center">' + pedido.data + '</td>';
    var linha5 = '<td class="text-center">' + pedido.formaPagamento + '</td>';
    var linha6 = '<td class="text-center">' + pedido.total.toFixed(2) + ' R$</td>';
    var linha7 = '</tr>';

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7;
}

function adicionarDivPedido(divPedido){
    $("tbody").append(divPedido);
}

function construirItems(pedido){
    var autenticacao = getAutenticacao();
    var usuario = null;
    $.ajax({
        url: '../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        data: 'email=' + autenticacao.email + '&senha=' + autenticacao.senha,
        processData: false,
        contentType: false,

        success: function(result){
            usuario = JSON.parse(result); 
        },
        error: function(xhr, status, error){

        }
    });
    return usuario;
}