<?php
require_once '../model/Usuario.php';
require_once '../database/UsuarioDAO.php';
require_once '../model/Pedido.php';
require_once '../database/PedidoDAO.php';
require_once '../model/Item.php';
require_once '../database/ItemDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php';


if($_SERVER["REQUEST_METHOD"] == "GET"){
    try {
        $conexao = FactoryDatabase::get();
        $usuarioDAO = new UsuarioDAO($conexao);
        $resultado = null;
        if ( isset($_GET["id"]) ){
            $usuario = new Usuario();
            $usuario->id = DataFilter::filter($_GET["id"]);
            $resultado = $usuarioDAO->lerPorId($usuario);
        } elseif ( isset($_GET["email"]) && isset($_GET["senha"]) ){
            $usuario = new Usuario();
            $usuario->email = DataFilter::filter($_GET["email"]);
            $usuario->senha = DataFilter::filter($_GET["senha"]);
            $resultado = $usuarioDAO->lerPorEmailESenha($usuario);
        } else {
            $resultado = $usuarioDAO->ler();
        }

        FactoryDatabase::close($conexao);
        echo json_encode($resultado);
    } catch(Exception $e){
        echo $e->getMessage();
    }
}

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    if ( isset($_POST["acao"]) ){
        $acao = DataFilter::filter($_POST["acao"]);
        switch($acao){
            case "criar": 
                echo criar();
                break;
            case "atualizar": 
                echo atualizar();
                break;
            case "deletar":
                echo deletar();
                break;
            default:
                echo "ACAO_INVALIDA";
        }
    } else {
        echo "ACAO_INVALIDA";
    }
    
}

function criar(){
    $conexao = FactoryDatabase::get();
    try {
        $usuario = new Usuario();
        if ( isset($_POST["cpf"]) )
            $usuario->cpf = DataFilter::filter($_POST["cpf"]);
        if ( isset($_POST["nome"]) )
            $usuario->nome = DataFilter::filter($_POST["nome"]);
        if ( isset($_POST["email"]) )
            $usuario->email = DataFilter::filter($_POST["email"]);
        if ( isset($_POST["senha"]) )
            $usuario->senha = hash('sha512', DataFilter::filter($_POST["senha"]));
        if ( isset($_POST["telefone"]) )
            $usuario->telefone = DataFilter::filter($_POST["telefone"]);
        if ( isset($_POST["data-nascimento"]))
            $usuario->dataNascimento = DataFilter::filter($_POST["data-nascimento"]);
        if ( isset($_POST["profissao"]) )
            $usuario->profissao = DataFilter::filter($_POST["profissao"]);
        if ( isset($_POST["endereco-entrega-cep"]) )
            $usuario->cepEntrega = DataFilter::filter($_POST["endereco-entrega-cep"]);
        if ( isset($_POST["endereco-entrega-lougradouro"]) )
            $usuario->lougradouroEntrega = DataFilter::filter($_POST["endereco-entrega-lougradouro"]);
        if ( isset($_POST["endereco-entrega-numero"]) )
            $usuario->numeroEntrega = DataFilter::filter($_POST["endereco-entrega-numero"]);
        if ( isset($_POST["endereco-entrega-bairro"]) )
            $usuario->bairroEntrega = DataFilter::filter($_POST["endereco-entrega-bairro"]);
        if ( isset($_POST["endereco-entrega-cidade"]) )
            $usuario->cidadeEntrega = DataFilter::filter($_POST["endereco-entrega-cidade"]);
        if ( isset($_POST["endereco-entrega-estado"]) )
            $usuario->estadoEntrega = DataFilter::filter($_POST["endereco-entrega-estado"]);
        if ( isset($_POST["endereco-residencial-cep"]) )
            $usuario->cepResidencial = DataFilter::filter($_POST["endereco-residencial-cep"]);
        if ( isset($_POST["endereco-residencial-lougradouro"]) )
            $usuario->lougradouroResidencial = DataFilter::filter($_POST["endereco-residencial-lougradouro"]);
        if ( isset($_POST["endereco-residencial-numero"]) )
            $usuario->numeroResidencial = DataFilter::filter($_POST["endereco-residencial-numero"]);
        if ( isset($_POST["endereco-residencial-bairro"]) )
            $usuario->bairroResidencial = DataFilter::filter($_POST["endereco-residencial-bairro"]);
        if ( isset($_POST["endereco-residencial-cidade"]) )
            $usuario->cidadeResidencial = DataFilter::filter($_POST["endereco-residencial-cidade"]);
        if ( isset($_POST["endereco-residencial-estado"]) )
            $usuario->estadoResidencial = DataFilter::filter($_POST["endereco-residencial-estado"]);
        $usuarioDAO = new UsuarioDAO($conexao);
        $usuarioDAO->criar($usuario);
        FactoryDatabase::close($conexao);
        return "CRIADO";
    }catch(Exception $e){
        $conexao->rollback();
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
}

function atualizar(){
    $conexao = FactoryDatabase::get();
    try{
        if ( ! isset($_POST["id"]) )
            throw new Exception("Id do cliente nao foi fornecido");
        $usuario = new Usuario();
        $usuario->id = DataFilter::filter($_POST["id"]);
        if ( isset($_POST["cpf"]) )
            $usuario->cpf = DataFilter::filter($_POST["cpf"]);
        if ( isset($_POST["nome"]) )
            $usuario->nome = DataFilter::filter($_POST["nome"]);
        if ( isset($_POST["email"]) )
            $usuario->email = DataFilter::filter($_POST["email"]);
        if ( isset($_POST["senha"]) )
            $usuario->senha = hash('sha512', DataFilter::filter($_POST["senha"]));
        if ( isset($_POST["telefone"]))
            $usuario->telefone = DataFilter::filter($_POST["telefone"]);
        if ( isset($_POST["data-nascimento"]))
            $usuario->dataNascimento = DataFilter::filter($_POST["data-nascimento"]);
        if ( isset($_POST["profissao"]) )
            $usuario->profissao = DataFilter::filter($_POST["profissao"]);
        if ( isset($_POST["endereco-entrega-cep"]) )
            $usuario->cepEntrega = DataFilter::filter($_POST["endereco-entrega-cep"]);
        if ( isset($_POST["endereco-entrega-lougradouro"]) )
            $usuario->lougradouroEntrega = DataFilter::filter($_POST["endereco-entrega-lougradouro"]);
        if ( isset($_POST["endereco-entrega-bairro"]) )
            $usuario->bairroEntrega = DataFilter::filter($_POST["endereco-entrega-bairro"]);
        if ( isset($_POST["endereco-entrega-cidade"]) )
            $usuario->cidadeEntrega = DataFilter::filter($_POST["endereco-entrega-cidade"]);
        if ( isset($_POST["endereco-entrega-estado"]) )
            $usuario->estadoEntrega = DataFilter::filter($_POST["endereco-entrega-estado"]);
        if ( isset($_POST["endereco-residencial-cep"]) )
            $usuario->cepResidencial = DataFilter::filter($_POST["endereco-residencial-cep"]);
        if ( isset($_POST["endereco-residencial-lougradouro"]) )
            $usuario->lougradouroResidencial = DataFilter::filter($_POST["endereco-residencial-lougradouro"]);
        if ( isset($_POST["endereco-residencial-bairro"]) )
            $usuario->bairroResidencial = DataFilter::filter($_POST["endereco-residencial-bairro"]);
        if ( isset($_POST["endereco-residencial-cidade"]) )
            $usuario->cidadeResidencial = DataFilter::filter($_POST["endereco-residencial-cidade"]);
        if ( isset($_POST["endereco-residencial-estado"]) )
            $usuario->estadoResidencial = DataFilter::filter($_POST["endereco-residencial-estado"]);
        $usuarioDAO = new UsuarioDAO($conexao);
        $usuarioDAO->atualizar($usuario);
        FactoryDatabase::close($conexao);   
        return "ATUALIZADO";
    } catch(Exception $e){
        $conexao->rollback();
        FactoryDatabase::close($conexao);  
        return $e->getMessage();
    }
}

function deletar(){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($_POST["id"]) )
            throw new Exception("Id do cliente deve ser fornecido"); 
        $conexao->begin_transaction();
        $usuarioDAO = new UsuarioDAO($conexao);
        $pedidoDAO = new PedidoDAO($conexao);
        $itemDAO = new ItemDAO($conexao);

        // Exclusao dos pedidos
        $pedido = new Pedido();
        $pedido->idUsuario = DataFilter::filter($_POST["id"]);
        $pedidos = $pedidoDAO->lerPorIdUsuario($pedido);
        foreach( $pedidos as $p ){
            $item = new Item();
            $item->idPedido = $p->id;
            $itemDAO->deletarPorIdPedido($item);
            $pedidoDAO->deletar($p);
        }

        // Exclusao do usuario
        $usuario = new Usuario();
        $usuario->id = DataFilter::filter($_POST["id"]);
        $usuarioDAO->deletar($usuario);
        $conexao->commit();
        FactoryDatabase::close($conexao);
        return "DELETADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
}

?>