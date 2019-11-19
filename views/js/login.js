function logar(){
    var usuario = buildUsuario();
    $.ajax({
        url: '../controller/AutenticacaoController.php',
        type: 'POST',
        async: true,
        data: usuario,
        processData: false,
        contentType: false,  

        success: function(result){
            if ( result.substring(0,9) == "PERMITIDO" ){
                $("#successMessage").stop().fadeIn(400).delay(2500).fadeOut(200);
                document.getElementById("btnLogin").disabled = true;
                window.location.assign("http://lauratasso.onlinewebshop.net/shopet/views/index.php");
            } else {
                document.getElementById("message").innerHTML = "Usuário não autenticado";
                $("#errorMessage").stop().fadeIn(400).delay(3500).fadeOut(200);
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
    formData.append("email", document.getElementById("email").value);
    formData.append("senha", document.getElementById("senha").value);
    return formData;
}



