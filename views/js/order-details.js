function onload(){
    showItems();
    showDetalhesCliente();
    showEnderecoEntrega();
    showPagamento();
}

function showItems(){
    var items = getItems();
    for ( var i=0; i < items.length; i++ ){
        var item = items[i];
        var divItem = construirDivItem(item);
        adicionarDivItem(divItem);
    }
}

function showDetalhesCliente(){
    var pedido = getPedido();
    var usuario = construirUsuario(pedido.idUsuario);
    document.getElementById("cpf").innerHTML = usuario.cpf || "";
    document.getElementById("nome").innerHTML = usuario.nome || "";
    document.getElementById("email").innerHTML = usuario.email || "";
    document.getElementById("telefone").innerHTML = usuario.telefone || "";
    document.getElementById("dataNascimento").innerHTML = usuario.dataNascimento || "";
    document.getElementById("dataNascimento").innerHTML = usuario.dataNascimento || "";
    document.getElementById("profissao").innerHTML = usuario.dataNascimento || "";
    
}

function showEnderecoEntrega(){
    var pedido = getPedido();
    var usuario = construirUsuario(pedido.idUsuario);
    document.getElementById("cep").innerHTML = usuario.cepEntrega || "";
    document.getElementById("lougradouro").innerHTML = usuario.lougradouroEntrega || "";
    document.getElementById("numero").innerHTML = usuario.numeroEntrega || "";
    document.getElementById("bairro").innerHTML = usuario.bairroEntrega || "";
    document.getElementById("cidade").innerHTML = usuario.cidadeEntrega || "";
    document.getElementById("estado").innerHTML = usuario.estadoEntrega || "";   
}

function showPagamento(){
    var pedido = getPedido();
    document.getElementById("formaPagamento").innerHTML = pedido.formaPagamento || "";
    document.getElementById("valor").innerHTML = pedido.total.toFixed(2) + " R$" || "";
}

function getItems(){
    var urlParams  = new URLSearchParams(window.location.search);
    var idPedido = urlParams.get('idPedido');
    var items = null;
    $.ajax({
        url: '../../controller/ItemController.php',
        type: 'GET',
        async: false,
        data: 'idPedido=' + idPedido,
        processData: false,
        contentType: false,

        success: function(result){
            items = JSON.parse(result);
        },
        error: function(xhr, status, error){
            items = [];
        }
    });
    return items;
}

function construirDivItem(item){
    var produto = construirProduto(item.idProduto);
    var linha1 = '<tr>'
    var linha2 = '<td></td>'
    var linha3 = '<td><img src="../../database/images/' + produto.imagem + '" width="50px" height="50px" /> </td>';
    var linha4 = '<td>' + produto.nome + '</td>';
    var linha5 = '<td class="text-center">' + item.quantidade + '</td>';
    var linha6 = '<td class="text-center">' + produto.precoVenda  + ' R$</td>';
    var linha7 = '</tr>'

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7;
}

function construirProduto(idProduto){
    var produto = null;
    $.ajax({
        url: '../../controller/ProdutoController.php',
        type: 'GET',
        async: false,
        data: 'id=' + idProduto,
        processData: false,
        contentType: false,

        success: function(result){
            produto = JSON.parse(result);
        },
        error: function(xhr, status, error){
            produto = null;
        }
    });
    return produto;
}

function adicionarDivItem(divItem){
    $("tbody").append(divItem);
}

function getPedido(){
    var urlParams = new URLSearchParams(window.location.search);
    var idPedido = urlParams.get('idPedido');
    var pedido = null;
    $.ajax({
        url: '../../controller/PedidoController.php',
        type: 'GET',
        async: false,
        data: 'id=' + idPedido,
        processData: false,
        contentType: false,

        success: function(result){
            pedido = JSON.parse(result);
        },
        error: function(xhr, status, error){
            pedido = null;
        }
    });
    return pedido;
}

function construirUsuario(idUsuario) {
    var parametros = new FormData();
    parametros.append('id', idUsuario);
    var usuario = null;
    $.ajax({
        url: '../../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        data: parametros,
        processData: false,
        contentType: false,

        success: function(result){
            usuario = JSON.parse(result)[0];
        },
        error: function(xhr, status, error){
            usuario = null;
        }
    });
    return usuario;
}


