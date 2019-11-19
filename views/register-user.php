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
    <script src="js/endereco.js"></script>
    <script src="js/register-user.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(function(){
            $("#cpf").mask('000.000.000-00', {reverse: true});
            $("#endereco-residencial-cep").mask('00000-000', {reverse: true});
            $("#endereco-entrega-cep").mask('00000-000', {reverse: true});
            $("#data-nascimento").mask('00/00/0000', {reverse: true});
            $("#telefone").mask('00 00000-0000', {reverse: true});
        })
    </script>
</head>

<body>
    <?php include "navbar.php"; ?>

    <div id="main" class="container-fluid"> 
        <br>
        <h3 class="page-header">Cadastro do usuário</h3>
        <hr />

        <div class="alert alert-success" id="successMessage" style="display: none; color: green;">
            <strong>Dados salvos com sucesso.</strong>
        </div>

        <div class="alert alert-danger" id="errorMessage" style="display: none; color: red;">
            <strong>Ocorreu uma falha ao executar a operação: </strong><span id="message"></span>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="cpf"><b>CPF:</b></label>
                <input type="text" id="cpf" class="form-control" placeholder="Digite seu CPF" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nome"><b>Nome:</b></label>
                <input type="text" id="nome" class="form-control" placeholder="Digite seu nome" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="email"><b>E-mail:</b></label>
                <input type="email" id="email" class="form-control" placeholder="Digite seu email" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="pwd"><b>Senha:</b></label>
                <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Senha incorreta.</div>
            </div>
        </div>
        <hr size="30">
        <div class="row">
            <div class="form-group col-md-4">
                <label><b>Endereço residencial</b></label> 
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="endereco-residencial-cep">CEP:</label>
                <input type="text" class="form-control" id="endereco-residencial-cep" placeholder="Digite o cep" onchange="autoCompletarEndereco(this)" required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-residencial-lougradouro">Lougradouro:</label>
                <input type="text" class="form-control" id="endereco-residencial-lougradouro"
                placeholder="Digite o lougradouro" required>
            </div>

            <div class="form-group col-md-4">
                <label for="endereco-residencial-numero">Número:</label>
                <input type="number" class="form-control" id="endereco-residencial-numero" placeholder="Número"
                required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="endereco-residencial-bairro">Bairro:</label>
                <input type="text" class="form-control" id="endereco-residencial-bairro" placeholder="Digite o bairro"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-residencial-cidade">Cidade:</label>
                <input type="text" class="form-control" id="endereco-residencial-cidade" placeholder="Digite a cidade"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-residencial-estado">Estado:</label>
                <select class="form-control" id="endereco-residencial-estado" required>
                    <option>Acre</option>
                    <option>Alagoas</option>
                    <option>Amapá</option>
                    <option>Amazonas</option>
                    <option>Bahia</option>
                    <option>Ceará</option>
                    <option>Distrito Federal</option>
                    <option>Espirito Santo</option>
                    <option>Goias</option>
                    <option>Maranhão</option>
                    <option>Mato Grosso</option>
                    <option>Mato Grosso do Sul</option>
                    <option>Minas Gerais</option>
                    <option>Pará</option>
                    <option>Paraíba</option>
                    <option>Paraná</option>
                    <option>Pernambuco</option>
                    <option>Piaui</option>
                    <option>Rio de Janeiro</option>
                    <option>Rio Grande do Norte</option>
                    <option>Rio Grande do Sul</option>
                    <option>Rondonia</option>
                    <option>Roraima</option>
                    <option>Santa Catarina</option>
                    <option>Sao Paulo</option>
                    <option>Sergipe</option>
                    <option>Tocantins</option>
                </select>
            </div>
        </div>
        <hr size="30">
        <div class="row">
            <div class="form-group col-md-4">
                <label><b>Endereço de entrega</b></label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="endereco-entrega-cep">CEP:</label>
                <input type="text" class="form-control" id="endereco-entrega-cep" placeholder="Digite o cep" onchange="autoCompletarEndereco(this)" required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-entrega-lougradouro">Lougradouro:</label>
                <input type="text" class="form-control" id="endereco-entrega-lougradouro"
                placeholder="Digite o lougradouro" required>
            </div>

            <div class="form-group col-md-4">
                <label for="endereco-entrega-numero">Número:</label>
                <input type="number" class="form-control" id="endereco-entrega-numero" placeholder="Número" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="endereco-entrega-bairro">Bairro:</label>
                <input type="text" class="form-control" id="endereco-entrega-bairro" placeholder="Digite o bairro"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-entrega-cidade">Cidade:</label>
                <input type="text" class="form-control" id="endereco-entrega-cidade" placeholder="Digite a cidade"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco-entrega-estado">Estado:</label>
                <select class="form-control" id="endereco-entrega-estado">
                    <option>Acre</option>
                    <option>Alagoas</option>
                    <option>Amapá</option>
                    <option>Amazonas</option>
                    <option>Bahia</option>
                    <option>Ceará</option>
                    <option>Distrito Federal</option>
                    <option>Espirito Santo</option>
                    <option>Goias</option>
                    <option>Maranhão</option>
                    <option>Mato Grosso</option>
                    <option>Mato Grosso do Sul</option>
                    <option>Minas Gerais</option>
                    <option>Pará</option>
                    <option>Paraíba</option>
                    <option>Paraná</option>
                    <option>Pernambuco</option>
                    <option>Piaui</option>
                    <option>Rio de Janeiro</option>
                    <option>Rio Grande do Norte</option>
                    <option>Rio Grande do Sul</option>
                    <option>Rondonia</option>
                    <option>Roraima</option>
                    <option>Santa Catarina</option>
                    <option>Sao Paulo</option>
                    <option>Sergipe</option>
                    <option>Tocantins</option>
                </select>
            </div>
        </div>
        <hr size="30">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="telefone"><b>Telefone de contato:</b></label>
                <input type="text" class="form-control" id="telefone" placeholder="(ddd) xxxxx xxxx" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Número de telefone incorreto.</div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="data-nascimento"><b>Data de nascimento:</b></label>
                <input type="text" class="form-control" id="data-nascimento" placeholder="dd/MM/yyyy" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback"> Data de nascimento inválida.</div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="profissao"><b>Profissão:</b></label>
                <input type="text" class="form-control" id="profissao" placeholder="Digite sua profissão" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback"> Profissão inválida.</div>
            </div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block" id="btnCadastrar" onclick="submit()">Cadastrar</button>
            </div>
            <div class="col-md-10">
                <a href="template.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
        <hr/>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>


