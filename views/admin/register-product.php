<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopet</title>

    <link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="../js/jquery-3.4.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/register-product.js"></script>

    <script>
        $(function(){
            $("#successMessage").hide();
            $("#errorMessage").hide();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="alert alert-success" id="successMessage" style="color:green;">
        <strong>Dados salvos com sucesso.</strong>
    </div>
    <div class="alert alert-danger" id="errorMessage" style="color: red;">
        <strong>Ocorreu uma falha ao executar a operação: </strong><span id="message"></span>
    </div>
    <div id="main" class="container-fluid">
        <br>
        <h3 class="page-header">Cadastro de produto</h3>
        <hr />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nome"><b>Nome:</b></label>
                <input type="text" id="nome" class="form-control" placeholder="Digite o nome do produto" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="fabricante"><b>Fabricante:</b></label>
                <input type="text" id="fabricante" class="form-control" placeholder="Digite o nome do fabricante"
                required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="descricao"><b>Descrição:</b></label>
                <textarea id="descricao" rows="5" class="form-control" placeholder="Digite a descrição"
                required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="preco"><b>Preço de venda:</b></label>
                <input type="number" id="preco-venda" class="form-control" value="1.00" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="quantidade"><b>Quantidade:</b></label>
                <input type="number" id="quantidade" class="form-control" value="1" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="quantidade"><b>Imagem descritiva:</b></label><br>
                <img src="https://dummyimage.com/600x400/55595c/fff" alt="img-thumbnail"
                class="form-control img-thumbnail" id="foto"><br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-foto"
                    accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" required>
                    <label class="custom-file-label" for="validatedCustomFile">Escolhar a imagem</label>
                    <div class="invalid-feedback">Foto inválida</div>
                </div>
            </div>
        </div>
        <br>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="btnCadastrar" onclick="submit()">Cadastrar</button>
                <a href="template.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
        <hr />
    </div>
    <?php include "footer.php"; ?>
</body>

</html>