function onload(){
    showClientes();
}

function showClientes(){
    var clientes = getClientes();
    for ( var i = 0; i < clientes.length; i++){
        var cliente = clientes[i];
        var divCliente = construirDivCliente(cliente);
        var divModal = construirDivModal(cliente);
        adicionarDivCliente(divCliente);
        adicionarDivModal(divModal);
    }
}

function getClientes(){
    var clientes = null;
    $.ajax({
        url: '../../controller/UsuarioController.php',
        type: 'GET',
        async: false,
        processData: false,
        contentType: false,

        success: function(result){
            clientes = JSON.parse(result);
        },
        error: function(xhr, status, error){

        }
    });
    return clientes;
}

function construirDivCliente(cliente){
    var linha1 = '<tr id="cliente-' + cliente.id +'">';
    var linha2 = '<td></td>';
    var linha3 = '<td class="text-center">' + cliente.id + '</td>';
    var linha4 = '<td class="text-center">' + cliente.cpf + '</td>';
    var linha5 = '<td class="text-center">' + cliente.nome + '</td>';
    var linha6 = '<td class="text-center">' + cliente.email + '</td>';
    var linha7 = '<td class="text-center">' + cliente.telefone + '</td>';
    var linha8 = '<td class="text-center">' + cliente.dataNascimento + '</td>';
    var linha9 = '<td class="text-center">' + cliente.profissao + '</td>';
    var linha10 = '<td class="text-center">';
    var linha11 = '<a href="orders-from-customer.php?idCliente=' + cliente.id + '" class="btn btn-sm btn-outline-primary">';
    var linha12 = '<i class="fa fa-shopping-cart"></i>';
    var linha13 = '</a>';
    var linha14 = '<a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal"';
    var linha15 = ' data-target="#modal-exclusao-' + cliente.id + '">';
    var linha16 = '<i class="fa fa-trash"></i>';
    var linha17 = '</a>';
    var linha18 = '</td>';
    var linha19 = '</tr>';

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7 + linha8 + linha9 + linha10 + linha11 + linha12 + linha13 + linha14 + linha15 + linha16 + linha17 + linha18 + linha19;
}

function construirDivModal(cliente){
    var linha1 = '<div id="modal-exclusao-' + cliente.id + '" class="modal fade" role="dialog">';
    var linha2 = '<div class="modal-dialog">';
    var linha3 = '<div class="modal-content">';
    var linha4 = '<div class="modal-header text-left">';
    var linha5 = '<h4 class="modal-title">Deseja realmente excluir?</h4>';
    var linha6 = '<button type="button" class="close" data-dismiss="modal">&times;</button>';
    var linha7 = '</div>';
    var linha8 = '<div class="modal-body">';
    var linha9 = '<p>A exclusão do cliente incluirá todo pedidos realizados pelo mesmo.</p>';
    var linha10 = '</div>';
    var linha11 = '<div class="modal-footer">';
    var linha12 = '<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="excluir(' + cliente.id + ')">Confirmar</button>';
    var linha13 = '</div>';
    var linha14 = '</div>';
    var linha15 = '</div>';
    var linha16 = '</div>';

    return linha1 + linha2 + linha3 + linha4 + linha5 + linha6 + linha7 + linha8 + linha9 + linha10 + linha11 + linha12 + linha13 + linha14 + linha15 + linha16;
}

function adicionarDivCliente(divCliente){
    $("tbody").append(divCliente);
}

function adicionarDivModal(divModal){
    $("#modals").append(divModal);
}

function excluir(idCliente){
    var cliente = new FormData();
    cliente.append("acao", "deletar");
    cliente.append("id", idCliente);
    $.ajax({
        url: '../../controller/UsuarioController.php',
        type: 'POST',
        async: false,
        data: cliente,
        processData: false,
        contentType: false,

        success: function(result){
            if ( result.substring(0,8) == "DELETADO" ){
                $("#cliente-" + idCliente).remove();
                $("#modal-exclusao-" + idCliente).remove();
                $("#successMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
            } else {
                document.getElementById("message").innerHTML = result;
                $("#errorMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
            }
        },
        error: function(xhr, status, error){
            document.getElementById("message").innerHTML = status + error + xhr.responseText;
            $("#errorMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
        }
    });
}
