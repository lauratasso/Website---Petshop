<?php

require_once '../model/Pedido.php';

class PedidoDAO {
    private $conexao;

    public function __construct(&$conexao){
        $this->conexao = $conexao;
    }
    
    public function lerPorId($pedido){
        $query                      = "select id, idUsuario, data, formaPagamento, total from pedido where id = ?";
        $statement                  = $this->conexao->prepare($query);
        $statement->bind_param("i", $pedido->id);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $idUsuario, $data, $formaPagamento, $total);
        $statement->fetch();
        $pedido = new Pedido();
        $pedido->id                 = $id;
        $pedido->idUsuario          = $idUsuario;
        $pedido->data               = $data;
        $pedido->formaPagamento     = $formaPagamento;
        $pedido->total              = $total;
        $statement->close();
        return $pedido;
    }

    public function lerPorIdUsuario($pedido){
        $query                      = "select id, idUsuario, data, formaPagamento, total from pedido where idUsuario = ?";
        $statement                  = $this->conexao->prepare($query);
        $statement->bind_param("i", $pedido->idUsuario);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $idUsuario, $data, $formaPagamento, $total);
        $pedidos = array();
        while ( $statement->fetch() ){
            $pedido                     = new Pedido();
            $pedido->id                 = $id;
            $pedido->idUsuario          = $idUsuario;
            $pedido->data               = $data;
            $pedido->formaPagamento     = $formaPagamento;
            $pedido->total              = $total;
            array_push($pedidos, $pedido);
        }
        return $pedidos;
    }

    public function ler(){
        $query                          = "select id, idUsuario, data, formaPagamento, total from pedido";
        $statement                      = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $idUsuario, $data, $formaPagamento, $total);
        $pedidos                        = array();
        while ( $statement->fetch() ){
            $pedido                     = new Pedido();
            $pedido->id                 = $id;
            $pedido->idUsuario          = $idUsuario;
            $pedido->data               = $data;
            $pedido->formaPagamento     = $formaPagamento;
            $pedido->total              = $total;
            array_push($pedidos, $pedido);
        }
        return $pedidos;
    }

    public function criar($pedido){
        $query          = "insert into pedido(idUsuario, data, formaPagamento, total) values (?, now(), ?, ?)";
        $statement      = $this->conexao->prepare($query);
        $idUsuario      = $pedido->idUsuario;
        $formaPagamento = $pedido->formaPagamento;
        $total          = $pedido->total;
        $statement->bind_param("isd", $idUsuario, $formaPagamento, $total);
        $statement->execute();
        $id = $statement->insert_id;
        $statement->close();
        return $id;
    }

    public function deletar($pedido){
        $query      = "delete from pedido where id = ?";
        $statement  = $this->conexao->prepare($query);
        $id         = $pedido->id;
        $statement->bind_param("i", $id);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }

    public function atualizar($pedido){
        $query          = "update pedido set data=now(), formaPagamento=?, total=? where id=?";
        $statement      = $this->conexao->prepare($query);
        $id             = $pedido->id;
        $formaPagamento = $pedido->formaPagamento;
        $total          = $pedido->total;
        $statement->bind_param("sdi", $formaPagamento, $total, $id);
        $statement->execute();
        $resultado      = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }
}

?>