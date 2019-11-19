$(function(){
    $("#successMessage").hide();
    $("#errorMessage").hide();
});
/*
 $(function() {
    'use strict';
    window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    window.scrollTo(0, 0);
                    $(function(){
                        $("#formInvalido").fadeIn();
                    });
                    var inc = document.getElementById('formInvalido').innerHTML ='ATENÇÃO! Dado(s) inválido(s)';
                }
                form.classList.add('was-validated');
            }, false);
        });
     }, false);
}
)();*/


function submit(){
    criarUsuario();
}

function criarUsuario(){
    var usuario = buildUsuario();
    $.ajax({
        url: '../controller/UsuarioController.php',
        type: 'POST',
        async: true,
        data: usuario,
        processData: false,
        contentType: false,

        success: function(result){
            if ( result.substring(0,6) == "CRIADO" ){
                $("#successMessage").stop().fadeIn(400).delay(7000).fadeOut(200);
                document.getElementById("btnCadastrar").disabled = true;
                window.scrollTo(0, 0);
            }
        },
        error: function(xhr, status, error){
            document.getElementById("message").innerHTML = status + error + xhr.responseText;
            $("#errorMessage").stop().fadeIn(400).delay(7000).fadeOut(200);
            window.scrollTo(0, 0);
        }
    });
}


function buildUsuario(){
    var formData = new FormData();
    formData.append("acao", "criar");
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