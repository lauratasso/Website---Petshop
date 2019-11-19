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
    <script src="js/carrinho.js"></script>
    <script src="js/cart.js"></script>
</head>

<body onload="onload()">
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
                                        <th scope="col">Produto</th>
                                        <th scope="col" class="text-center">Quantidade</th>
                                        <th scope="col" class="text-center">Preço Unitário (R$)</th>
                                        <th scope="col" class="text-center">Sub-total</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="modal-exclusao" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header text-left">
                                    <h4 class="modal-title">Deseja realmente excluir?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>A exclusão do item removerá de seu carrinho.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" 
                                    id="btnConfirm">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 text-right">
                                <a href="index.php" class="btn btn-lg btn-block btn-secondary text-uppercase">Continuar comprando</a>
                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                                <a id="linkFinalizarCompra" href="complete-purchase.php" class="btn btn-lg btn-block btn-success text-uppercase">Finalizar compra</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>