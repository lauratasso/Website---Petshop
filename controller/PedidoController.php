<?php
require_once '../model/Usuario.php';
require_once '../database/UsuarioDAO.php';
require_once '../model/Pedido.php';
require_once '../database/PedidoDAO.php';
require_once '../model/Item.php';
require_once '../database/ItemDAO.php';
require_once '../model/Produto.php';
require_once '../database/ProdutoDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $conexao = FactoryDatabase::get();
    try {
        $pedidoDAO = new PedidoDAO($conexao);
        $resultado = null;
        if ( isset($_GET["id"]) ){
            $pedido = new Pedido();
            $pedido->id = DataFilter::filter($_GET["id"]);
            $resultado = $pedidoDAO->lerPorId($pedido);
        } elseif ( isset($_GET["idUsuario"]) ){
            $pedido = new Pedido();
            $pedido->idUsuario = DataFilter::filter($_GET["idUsuario"]);
            $resultado = $pedidoDAO->lerPorIdUsuario($pedido);
        } else {
            $resultado = $pedidoDAO->ler();
        }

        FactoryDatabase::close($conexao);
        echo json_encode($resultado);
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }
    
}

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    $json = file_get_contents('php://input');
    $parametros = json_decode($json);
    $acao = DataFilter::filter($parametros->acao);
    switch($acao){
        case "criar": 
            echo criar($parametros);
            break;
        case "atualizar": 
            echo atualizar($parametros);
            break;
        case "deletar":
            echo deletar($parametros);
            break;
        default:
            echo "ACAO_INVALIDA";
    }
    
}

function criar($parametros){
    session_start();
    $conexao = FactoryDatabase::get();
    try {
        $conexao->begin_transaction();
        $usuarioDAO = new UsuarioDAO($conexao);
        $produtoDAO = new ProdutoDAO($conexao);
        $pedidoDAO  = new PedidoDAO($conexao);
        $itemDAO    = new ItemDAO($conexao);

        $usuario         = new Usuario();
        $usuario->email  = $_SESSION["email"];
        $usuario->senha  = $_SESSION["senha"];
        $usuario = $usuarioDAO->lerPorEmailESenha($usuario);
        
        // Criando Pedido
        $pedido     = new Pedido();
        $pedido->idUsuario = $usuario->id;
        $pedido->formaPagamento = DataFilter::filter($parametros->formaPagamento);
        $idPedido = $pedidoDAO->criar($pedido);

        // Criando Item
        $items = $parametros->items->produtos;
        $produto = new Produto();
        foreach( $items as $i ){
            $item               = new Item();
            $item->idPedido     = $idPedido;
            $item->idProduto    = $i->id;
            $item->quantidade   = $i->quantidade;
            $itemDAO->criar($item);
        }
    
        // Calculando o total
        $total = 0.0;
        $item = new Item();
        $item->idPedido = $idPedido;
        $items = $itemDAO->lerPorIdPedido($item);
        foreach( $items as $item ){
            $produto = new Produto();
            $produto->id = $item->idProduto;
            $produto = $produtoDAO->lerPorId($produto);
            $total = $total + ($item->quantidade * $produto->precoVenda);
        }

        $pedido = new Pedido();
        $pedido->id = $idPedido;
        $pedido = $pedidoDAO->lerPorId($pedido);
        $pedido->total = $total;        
        $pedidoDAO->atualizar($pedido);

        $conexao->commit();        
        FactoryDatabase::close($conexao);
        return "CRIADO";
    } catch(Exception $e){
        $conexao->rollback();
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
    
}

function atualizar($parametros){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($parametros->id) || ! isset($parametros->idUsuario) )
            throw new Exception("Id do pedido e do usuario deve ser fornecido");
        $pedido               = new Pedido();
        $pedido->id           = DataFilter::filter($parametros->id);
        $pedido->idUsuario    = DataFilter::filter($parametros->idUsuario);
        if ( isset($parametros->data) )
            $pedido->data = DataFilter::filter($parametros->data);
        if ( isset($parametros->formaPagamento) )
            $pedido->formaPagamento = DataFilter::filter($parametros->formaPagamento);
        $conexao->begin_transaction();
        $pedidoDAO = new PedidoDAO($conexao);
        $pedidoDAO->atualizar($pedido);
        $conexao->commit();
        FactoryDatabase::close($conexao);
        return "ATUALIZADO";
    } catch(Exception $e){
        $conexao->rollback();
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
}

function deletar($parametros){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($parametros->id) || ! isset($parametros->idUsuario) )
            throw new Exception("Id do pedido e do usuario deve ser fornecido");
        $pedido               = new Pedido();
        $pedido->id           = DataFilter::filter($parametros->id);
        $pedido->idUsuario    = DataFilter::filter($parametros->idUsuario);
        $conexao              = FactoryDatabase::get();
        $pedidoDAO            = new PedidoDAO($conexao);
        $pedidoDAO->deletar($pedido);
        FactoryDatabase::close($conexao);
        echo "DELETADO";
    } catch(Exception  $e){
        echo $e->getMessage();
    }
    
}

?>