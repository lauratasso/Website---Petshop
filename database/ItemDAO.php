<?php

require_once '../model/Item.php';

class ItemDAO {
    private $conexao;

    public function __construct(&$conexao){
        $this->conexao = $conexao;
    }
    
    public function lerPorId($item){
        $query              = "select idPedido, idProduto, quantidade from item where idPedido = ? and idProduto = ?";
        $statement          = $this->conexao->prepare($query);
        $statement->bind_param("ii", $item->idPedido, $item->idProduto);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($idPedido, $idProduto, $quantidade);
        $statement->fetch();
        $item               = new Item();
        $item->id           = $idPedido;
        $item->idUsuario    = $idProduto;
        $item->quantidade   = $quantidade;
        $statement->close();
        return $item;
    }

    public function lerPorIdPedido($item){
        $query              = "select idPedido, idProduto, quantidade from item where idPedido = ?";
        $statement          = $this->conexao->prepare($query);
        $statement->bind_param("i", $item->idPedido);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($idPedido, $idProduto, $quantidade);
        $items                  = array();
        while ( $statement->fetch() ){
            $item               = new Item();
            $item->idPedido     = $idPedido;
            $item->idProduto    = $idProduto;
            $item->quantidade   = $quantidade;
            array_push($items, $item);
        }
        return $items;
    }

    public function ler(){
        $query                  = "select idPedido, idProduto, quantidade from item";
        $statement              = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($idPedido, $idProduto, $quantidade);
        $items                  = array();
        while ( $statement->fetch() ){
            $item               = new Item();
            $item->idPedido     = $idPedido;
            $item->idProduto    = $idProduto;
            $item->quantidade   = $quantidade;
            array_push($items, $item);
        }
        return $items;
    }

    public function criar($item){
        $query          = "insert into item(idPedido, idProduto, quantidade) values (?, ?, ?)";
        $statement      = $this->conexao->prepare($query);
        $idPedido       = $item->idPedido;
        $idProduto      = $item->idProduto;
        $quantidade     = $item->quantidade;
        $statement->bind_param("iii", $idPedido, $idProduto, $quantidade);
        $resultado      = $statement->execute();
        $statement->close();
        return $resultado != 0 ? true : false;
    }

    public function deletar($item){
        $query      = "delete from item where idPedido = ? and idProduto = ?";
        $statement  = $this->conexao->prepare($query);
        $idPedido   = $item->idPedido;
        $idProduto  = $item->idProduto;
        $statement->bind_param("ii", $idPedido, $idProduto);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }

    public function deletarPorIdPedido($item){
        $query      = "delete from item where idPedido = ?";
        $statement  = $this->conexao->prepare($query);
        $idPedido   = $item->idPedido;
        $statement->bind_param("i", $idPedido);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }

    public function atualizar($item){
        $query      = "update produto set quantidade=? where idPedido = ? and idProduto = ?";
        $statement  = $this->conexao->prepare($query);
        $quantidade = $item->quantidade;
        $idPedido   = $item->idPedido;
        $idProduto  = $item->idProduto;
        $statement->bind_param("iii", $quantidade, $idPedido, $idProduto);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }
}

?>