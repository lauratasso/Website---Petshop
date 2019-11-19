<?php
require_once '../model/Item.php';
require_once '../database/ItemDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $conexao = FactoryDatabase::get();
    try {
        $itemDAO        = new ItemDAO($conexao);
        $resultado      = null;
        if ( isset($_GET["idPedido"]) && isset($_GET["idProduto"]) ){
            $item = new Item();
            $item->idPedido = DataFilter::filter($_GET["idPedido"]);
            $item->idProduto = DataFilter::filter($_GET["idProduto"]);
            $resultado = $itemDAO->lerPorId($item);
        } elseif( isset($_GET["idPedido"]) && ! isset($_GET["idProduto"])) {
            $item = new Item();
            $item->idPedido = DataFilter::filter($_GET["idPedido"]);
            $resultado = $itemDAO->lerPorIdPedido($item);
        }else {
            $resultado = $itemDAO->ler();
        } 
        FactoryDatabase::close($conexao);
        echo json_encode($resultado);
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }
    
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($_POST["idPedido"]) || ! isset($_POST["idProduto"]) )
            throw new Exception("Id do pedido e do produto deve ser fornecido");
        $item               = new Item();
        $item->idPedido     = DataFilter::filter($_POST["idPedido"]);
        $item->idProduto    = DataFilter::filter($_POST["idProduto"]);
        if ( isset($_POST["quantidade"]) )
            $item->quantidade = DataFilter::filter($_POST["quantidade"]);
        $itemDAO = new ItemDAO($conexao);
        $itemDAO->criar($item);
        FactoryDatabase::close($conexao);
        echo "CRIADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }
    
}

if($_SERVER["REQUEST_METHOD"] == "PUT"){
    $conexao = FactoryDatabase::get();
    try{
        if ( ! isset($_PUT["idPedido"]) || ! isset($_PUT["idProduto"]) )
            throw new Exception("Id do pedido e do produto deve ser fornecido");
        $item               = new Item();
        $item->idPedido     = DataFilter::filter($_PUT["idPedido"]);
        $item->idProduto    = DataFilter::filter($_PUT["idProduto"]);
        if ( isset($_PUT["quantidade"]) )
            $item->quantidade = DataFilter::filter($_PUT["quantidade"]);
        $itemDAO = new ItemDAO($conexao);
        $itemDAO->atualizar($item);
        FactoryDatabase::close($conexao);
        echo "ATUALIZADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }
   
}

if($_SERVER["REQUEST_METHOD"] == "DELETE"){
    try {
        if ( ! isset($_DELETE["id"]) || ! isset($_DELETE["idPedido"]) )
            throw new Exception("Id do pedido e do usuario deve ser fornecido");
        $item               = new Item();
        $item->id           = DataFilter::filter($_DELETE["id"]);
        $item->idPedido     = DataFilter::filter($_DELETE["idPedido"]);
        $conexao            = FactoryDatabase::get();
        $itemDAO            = new ItemDAO($conexao);
        $itemDAO->deletar($item);
        FactoryDatabase::close($conexao);
        echo "DELETADO";
    } catch(Exception $e){
        echo $e->getMessage();
    }
   
}

?>