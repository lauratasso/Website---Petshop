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
    <script src="../js/carrinho.js"></script>
    <script src="../js/autenticacao.js"></script>
    <script src="../js/order-details.js"></script>
</head>

<body onload="onload()">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
        <div id="cart">
            <br>
            <h3 class="page-header">Detalhes do pedido</h3>
            <hr />
            <br>
            <div class="container mb-4">
                <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped"> 
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col" class="text-center">Quantidade</th>
                                    <th scope="col" class="text-center">Preço Unitário (R$)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <br>
                <div class="col mb-2">
                    <h4 class="page-header">Detalhes do Cliente</h4>
                    <hr />
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <p><strong>CPF</strong></p>
                            <p id="cpf">000.000.000-00</p>
                        </div>
                        <div class="form-group col-md-4">
                            <p><strong>Nome</strong></p>
                            <p id="nome">Nome XXX</p>
                        </div>

                        <div class="form-group col-md-4">
                            <p><strong>Email</strong></p>
                            <p id="email">email@email.com.br</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <p><strong>Telefone</strong></p>
                            <p id="telefone">Telefone XXX</p>
                        </div>
                        <div class="form-group col-md-4">
                            <p><strong>Data de nascimento</strong></p>
                            <p id="dataNascimento">00/00/0000</p>
                        </div>

                        <div class="form-group col-md-4">
                            <p><strong>Profissao</strong></p>
                            <p id="profissao">Profissao XXX</p>
                        </div>
                    </div>
                </div>
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
                    <h4 class="page-header">Pagamento</h4>
                    <hr />
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <p><strong>Forma de pagamento</strong></p>
                            <p id="formaPagamento">0000-000</p>
                        </div>
                        <div class="form-group col-md-4">
                            <p><strong>Valor</strong></p>
                            <p id="valor">100 R$</p>
                        </div>

                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>