function onload(){
    redicionarSeNaoLogado('login.php');
    preencherFomulario();
}

function preencherFomulario(){
    var autenticacao = getAutenticacao();
    var usuario = carregarUsuario(autenticacao);
    document.getElementById("id").value                                 = usuario.id;
    document.getElementById("cpf").value                                = usuario.cpf || "";
    document.getElementById("nome").value                               = usuario.nome || "";
    document.getElementById("email").value                              = usuario.email || "";
    document.getElementById("telefone").value                           = usuario.telefone || "";
    document.getElementById("data-nascimento").value                    = usuario.dataNascimento || "";
    document.getElementById("profissao").value                          = usuario.profissao || "";
    document.getElementById("endereco-entrega-cep").value               = usuario.cepEntrega || "";
    document.getElementById("endereco-entrega-lougradouro").value       = usuario.lougradouroEntrega || "";
    document.getElementById("endereco-entrega-numero").value            = usuario.numeroEntrega || "";
    document.getElementById("endereco-entrega-bairro").value            = usuario.bairroEntrega || "";
    document.getElementById("endereco-entrega-cidade").value            = usuario.cidadeEntrega || "";
    document.getElementById("endereco-entrega-estado").value            = usuario.estadoEntrega || "";
    document.getElementById("endereco-residencial-cep").value           = usuario.cepResidencial || "";
    document.getElementById("endereco-residencial-lougradouro").value   = usuario.lougradouroResidencial || "";
    document.getElementById("endereco-residencial-numero").value        = usuario.numeroResidencial || "";
    document.getElementById("endereco-residencial-bairro").value        = usuario.bairroResidencial || "";
    document.getElementById("endereco-residencial-cidade").value        = usuario.cidadeResidencial || "";
    document.getElementById("endereco-residencial-estado").value        = usuario.estadoResidencial || "";
}

function carregarUsuario(autenticacao){
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

function submit(){
    var usuario = buildUsuario();
    $.ajax({
        url: '../controller/UsuarioController.php',
        type: 'POST',
        async: true,
        data: usuario,
        processData: false,
        contentType: false,

        success: function(result){
            if ( result.substring(0,10) == "ATUALIZADO" ){
                $("#successMessage").stop().fadeIn(400).delay(2500).fadeOut(200);
                document.getElementById("btnAtualizar").disabled = true;
            }
        },
        error: function(xhr, status, error){
            document.getElementById("message").innerHTML = status + error + xhr.responseText;
            $("#errorMessage").stop().fadeIn(400).delay(2500).fadeOut(200);
        }
    });
}


function buildUsuario(){
    var formData = new FormData();
    formData.append("acao", "atualizar");
    formData.append("id", document.getElementById("id").value);
    formData.append("cpf", document.getElementById("cpf").value);
    formData.append("nome", document.getElementById("nome").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("senha", document.getElementById("senha").value);
    formData.append("telefone", document.getElementById("telefone").value);
    formData.append("data-nascimento", document.getElementById("data-nascimento").value);
    formData.append("profissao", document.getElementById("profissao").value);
    formData.append("endereco-entrega-cep", document.getElementById("endereco-entrega-cep").value);
    formData.append("endereco-entrega-lougradouro", document.getElementById("endereco-entrega-lougradouro").value);
    formData.append("endereco-entrega-numero", document.getElementById("endereco-entrega-numero").value);
    formData.append("endereco-entrega-bairro", document.getElementById("endereco-entrega-bairro").value);
    formData.append("endereco-entrega-cidade", document.getElementById("endereco-entrega-cidade").value);
    formData.append("endereco-entrega-estado", document.getElementById("endereco-entrega-estado").value);
    formData.append("endereco-residencial-cep", document.getElementById("endereco-residencial-cep").value);
    formData.append("endereco-residencial-lougradouro", document.getElementById("endereco-residencial-lougradouro").value);
    formData.append("endereco-residencial-numero", document.getElementById("endereco-residencial-numero").value);
    formData.append("endereco-residencial-bairro", document.getElementById("endereco-residencial-bairro").value);
    formData.append("endereco-residencial-cidade", document.getElementById("endereco-residencial-cidade").value);
    formData.append("endereco-residencial-estado", document.getElementById("endereco-residencial-estado").value);
    return formData;
}

function buildUsuario2(){
    var formData = "";
    formData = formData + "id=" + document.getElementById("id").value;
    formData = formData + "&cpf=" + document.getElementById("cpf").value;
    formData = formData + "&nome=" + document.getElementById("nome").value;
    formData = formData + "&email=" + document.getElementById("email").value;
    formData = formData + "&senha=" + document.getElementById("senha").value;
    formData = formData + "&telefone=" + document.getElementById("telefone").value;
    formData = formData + "&data-nascimento=" + document.getElementById("data-nascimento").value;
    formData = formData + "&profissao=" + document.getElementById("profissao").value;
    formData = formData + "&endereco-entrega-cep=" + document.getElementById("endereco-entrega-cep").value;
    formData = formData + "&endereco-entrega-lougradouro=" + document.getElementById("endereco-entrega-lougradouro").value;
    formData = formData + "&endereco-entrega-numero=" + document.getElementById("endereco-entrega-numero").value;
    formData = formData + "&endereco-entrega-bairro=" + document.getElementById("endereco-entrega-bairro").value;
    formData = formData + "&endereco-entrega-cidade=" + document.getElementById("endereco-entrega-cidade").value;
    formData = formData + "&endereco-entrega-estado=" + document.getElementById("endereco-entrega-estado").value;
    formData = formData + "&endereco-residencial-cep=" + document.getElementById("endereco-residencial-cep").value;
    formData = formData + "&endereco-residencial-lougradouro=" + document.getElementById("endereco-residencial-lougradouro").value;
    formData = formData + "&endereco-residencial-numero=" + document.getElementById("endereco-residencial-numero").value;
    formData = formData + "&endereco-residencial-bairro=" + document.getElementById("endereco-residencial-bairro").value;
    formData = formData + "&endereco-residencial-cidade=" + document.getElementById("endereco-residencial-cidade").value;
    formData = formData + "&endereco-residencial-estado=" + document.getElementById("endereco-residencial-estado").value;
    return formData;
}

function buildUsuario3(){
    var formData = {};
    formData["id"]=document.getElementById("id").value;
    formData["cpf"]=document.getElementById("cpf").value;
    formData["nome"]=document.getElementById("nome").value;
    formData["email"]=document.getElementById("email").value;
    formData["senha"]=document.getElementById("senha").value;
    formData["telefone"]=document.getElementById("telefone").value;
    formData["data-nascimento"]=document.getElementById("data-nascimento").value;
    formData["profissao"]=document.getElementById("profissao").value;
    formData["endereco-entrega-cep"]=document.getElementById("endereco-entrega-cep").value;
    formData["endereco-entrega-lougradouro"]=document.getElementById("endereco-entrega-lougradouro").value;
    formData["endereco-entrega-numero"]=document.getElementById("endereco-entrega-numero").value;
    formData["endereco-entrega-bairro"]=document.getElementById("endereco-entrega-bairro").value;
    formData["endereco-entrega-cidade"]=document.getElementById("endereco-entrega-cidade").value;
    formData["endereco-entrega-estado"]=document.getElementById("endereco-entrega-estado").value;
    formData["endereco-residencial-cep"]=document.getElementById("endereco-residencial-cep").value;
    formData["endereco-residencial-lougradouro"]=document.getElementById("endereco-residencial-lougradouro").value;
    formData["endereco-residencial-numero"]=document.getElementById("endereco-residencial-numero").value;
    formData["endereco-residencial-bairro"]=document.getElementById("endereco-residencial-bairro").value;
    formData["endereco-residencial-cidade"]=document.getElementById("endereco-residencial-cidade").value;
    formData["endereco-residencial-estado"]=document.getElementById("endereco-residencial-estado").value;
    return JSON.stringify(formData);
}

function autoCompletarEndereco(element){
    var endereco = encontrarEnderecoPorCep(element.value);
    if ( element.id == "endereco-entrega-cep" ){
        document.getElementById("endereco-entrega-lougradouro").value = endereco.lougradouro;
        document.getElementById("endereco-entrega-bairro").value = endereco.bairro;
        document.getElementById("endereco-entrega-cidade").value = endereco.cidade;
        document.getElementById("endereco-entrega-estado").value = endereco.estado;
    } else {
        document.getElementById("endereco-residencial-lougradouro").value = endereco.lougradouro;
        document.getElementById("endereco-residencial-bairro").value = endereco.bairro;
        document.getElementById("endereco-residencial-cidade").value = endereco.cidade;
        document.getElementById("endereco-residencial-estado").value = endereco.estado;
    }
}