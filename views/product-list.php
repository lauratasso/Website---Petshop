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
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
        <div id="cart">
            <br>
            <h3 class="page-header">Carrinho</h3>
            <hr />
            <br>
            <div class="container mb-4">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col" class="text-center">Produto</th>
                                        <th scope="col" class="text-center">Quantidade</th>
                                        <th scope="col" class="text-center">Preço Unitário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="images/products/product1.jpg" width="50px" height="50px" /> </td>
                                        <td class="text-center">Ração Golden Special Sabor Frango e Carne para Cães Adultos</td>
                                        <td class="text-center">1 unidades</td>
                                        <td class="text-center">104,90 R$</td>
                                    </tr>
                                    <tr>
                                            <td><img src="images/products/product2.jpg" width="50px" height="50px" /> </td>
                                        <td class="text-center">Whiskas Bola de Pelo para Gatos Adultos - 40g</td>
                                        <td class="text-center">1 unidades</td>
                                        <td class="text-center">5,49 R$</td>
                                    </tr>
                                    <tr>
                                            <td><img src="images/products/product3.jpg" width="50px" height="50px" /> </td>
                                        <td class="text-center">Criadeira Mônaco para Pássaros Castelo com Bandeja</td>
                                        <td class="text-center">1 unidades</td>
                                        <td class="text-center">179,99 R$</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

</body>

</html>