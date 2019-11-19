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
    <script src="js/autenticacao.js"></script>
    <script src="js/complete-purchase.js"></script>
</head>

<body onload="onload()">
    <?php include "navbar.php"; ?><br>
    <div class="alert alert-success" id="successMessage" style="display: none;">
        <strong>Compra realizada com sucesso.</strong>
    </div>
    <div class="alert alert-danger" id="errorMessage" style="display: none;">
        <strong>Ocorreu uma falha ao executar a operação: </strong><span id="message"></span>
    </div>
    <div class="container-fluid">
        <div id="cart">
            <br>
            <h3 class="page-header">Concluir pedido</h3>
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
            </div>
                <br>
                <div class="col mb-2">
                    <h4 class="page-header">Endereço de entrega</h4>
                    <hr />
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <p><strong>CEP</strong></p>
                            <p id="cep">0000-000</p>
                        </div>
                        <div class="form-group col-md-4">
                            <p><strong>Lougradouro</strong></p>
                            <p id="lougradouro">Rua XXX</p>
                        </div>

                        <div class="form-group col-md-4">
                            <p><strong>Número</strong></p>
                            <p id="numero">XXXX</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <p><strong>Bairro</strong></p>
                            <p id="bairro">Bairro XXX</p>
                        </div>
                        <div class="form-group col-md-4">
                            <p><strong>Cidade</strong></p>
                            <p id="cidade">Cidade XXX</p>
                        </div>

                        <div class="form-group col-md-4">
                            <p><strong>Estado</strong></p>
                            <p id="estado">Estado XXX</p>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col mb-2">
                    <h4 class="page-header">Formas de pagamento</h4>
                    <hr />
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label><b>Cartão de crédito</b></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="numero-cartao">Número do cartão:</label>
                            <input type="number" class="form-control" id="numero-cartao" required>
                        </div>
                        <div class="form-group col">
                            <label for="nome-titular">Nome do titular:</label>
                            <input type="text" class="form-control" id="nome-titular" required>
                        </div>

                        <div class="form-group col">
                            <label for="codigo-seguranca">Código de segurança:</label>
                            <input type="number" class="form-control" id="endereco-entrega-numero" required>
                        </div>

                        <div class="form-group col">
                            <label for="codigo-seguranca">Data de validade:</label>
                            <input type="text" class="form-control" id="data-validade" placeholder="mm/yyyy" required>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 text-right">
                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                                <button id="concluirCartaoCredito" type="button" class="btn btn-lg btn-block btn-success text-uppercase" onclick="concluirCartao()">Concluir com cartão de crédito</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr />
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label><b>Boleto bancário</b></label> 
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 text-right">
                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                                <button id="concluirBoletoBancario" type="button" class="btn btn-lg btn-block btn-success text-uppercase" onclick="concluirBoleto()">Concluir com boleto bancário</button>
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