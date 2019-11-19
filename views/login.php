<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopet</title>

    <link rel="shortcut icon" href="images/logo.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dropdown.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>
</head>
 
<body>
    <?php include "navbar.php"; ?><br>
    <div class="alert alert-success" id="successMessage" style="display: none;">
        <strong>Login feito com sucesso.</strong>
    </div>
    <div class="alert alert-danger" id="errorMessage" style="display: none;">
        <strong>Ocorreu uma falha ao executar a operação: </strong><span id="message"></span>
    </div>
    <div class="container-fluid">
        <br>
        <h3 class="page-header">Login</h3>
        <hr />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="email">E-mail:</label>
                <input type="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="pwd">Senha:</label>
                <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
            </div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block" id="btnLogin" onclick="logar()">Entrar</button>
            </div>
            <div class="col-md-10">
                <a href="index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
        <br>
         <div id="actions" class="row">
            <div class="col-md-12">
                <a href="register-user.php">
                    <input type="button" class="btn btn-link" id="botaoCadastrar" value="Cadastre-se" style="color:red;">
                </a>
            </div>
        </div>
        <hr />
    </div>
    <?php include "footer.php"; ?>
</body>

</html>