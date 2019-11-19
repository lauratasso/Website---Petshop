function encontrarEnderecoPorCep(cep){
    var endereco = null;
    $.ajax({
        url: '../controller/EnderecoController.php',
        type: 'GET',
        async: false,
        data: 'cep=' + cep,
        processData: false,
        contentType: false,
        
        success: function(result){
            if ( result != "" ){
                endereco = JSON.parse(result);
            }
        },
        error: function(xhr, status, error){
            
        }
    });
    return endereco;
}