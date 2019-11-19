function logout(){
    $.ajax({
        url: '../controller/AutenticacaoController.php',
        type: 'DELETE',
        async: true,
        processData: false,
        contentType: false, 

        success: function(result){
            window.location.assign("http://lauratasso.onlinewebshop.net/shopet/views/index.php");
        },
        error: function(xhr, status, error){

        }
    });
}