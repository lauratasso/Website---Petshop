function submit(){
    var produto = buildProduto();
    $.ajax({
        url: '../../controller/ProdutoController.php',
        type: 'POST',
        async: true,
        data: produto,
        processData: false,
        contentType: false,

        success: function(result){
            if ( result.substring(0,6) == "CRIADO" ){
                $("#successMessage").stop().fadeIn(200).delay(2500).fadeOut(200);
                document.getElementById("btnCadastrar").disabled = true;
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

function buildProduto(){
    var formData = new FormData();
    formData.append("acao", "criar");
    formData.append("nome", document.getElementById("nome").value);
    formData.append("fabricante", document.getElementById("fabricante").value);
    formData.append("descricao", document.getElementById("descricao").value);
    formData.append("preco-venda", document.getElementById("preco-venda").value);
    formData.append("quantidade", document.getElementById("quantidade").value);
    formData.append("imagem", $('input[type=file]')[0].files[0]);
    return formData;
}
