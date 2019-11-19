<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopet</title>

    <link rel="shortcut icon" href="images/logo.ico" type="image/x-icon"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dropdown.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</head>

<body onload="onload()">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
        <div id="news">
            <br>
            <h3 class="page-header">Novidades</h3>
            <hr />
            <div id="new-row" class="row">
            </div>
            <hr />
        </div>
        <div id="products">
            <br>
            <h3 class="page-header">Produtos</h3>
            <hr />
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>