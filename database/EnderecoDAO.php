<?php

require_once '../model/Endereco.php';

class EnderecoDAO {
    private $conexao;

    public function __construct(&$conexao){
        $this->conexao = $conexao;
    }

    public function lerPorId($endereco){
        $query                  = "select id, cep, lougradouro, bairro, cidade, estado from endereco where id = ?";
        $statement              = $this->conexao->prepare($query);
        $statement->bind_param("i", $endereco->id);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $cep, $lougradouro, $bairro, $cidade, $estado);
        $statement->fetch();
        $result               = new Endereco();
        $result->id           = $id;
        $result->cep          = $cep;
        $result->lougradouro  = $lougradouro;
        $result->bairro       = $bairro;
        $result->cidade       = $cidade;
        $result->estado       = $estado;
        $statement->close();
        return $result;
    }

    public function lerPorCep($endereco){
        $query                  = "select id, cep, lougradouro, bairro, cidade, estado from endereco where cep = ? ";
        $statement              = $this->conexao->prepare($query);
        $statement->bind_param("s", $endereco->cep);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $cep, $lougradouro, $bairro, $cidade, $estado);
        $statement->fetch();
        $endereco               = new Endereco();
        $endereco->id           = $id;
        $endereco->cep          = $cep;
        $endereco->lougradouro  = $lougradouro;
        $endereco->bairro       = $bairro;
        $endereco->cidade       = $cidade;
        $endereco->estado       = $estado;
        $statement->close();
        return $endereco;
    }

    public function ler(){
        $query                      = "select id, cep, lougradouro, bairro, cidade, estado from endereco";
        $statement                  = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $cep, $lougradouro, $bairro, $cidade, $estado);
        $enderecos                  = array();
        while  ( $statement->fetch() ){
            $endereco               = new Endereco();
            $endereco->id           = $id;
            $endereco->cep          = $cep;
            $endereco->lougradouro  = $lougradouro;
            $endereco->bairro       = $bairro;
            $endereco->cidade       = $cidade;
            $endereco->estado       = $estado;
            array_push($enderecos, $endereco);
        }
        $statement->close();
        return $enderecos;
    }

    public function criar($endereco){
        $query          = "insert into endereco(cep, lougradouro,bairro, cidade, estado) values (?, ?, ?, ?, ?, ?)";
        $statement      = $this->conexao->prepare($query);
        $cep            = $endereco->cep;
        $lougradouro    = $endereco->lougradouro;
        $bairro         = $endereco->bairro;
        $cidade         = $endereco->cidade;
        $estado         = $endereco->estado;
        $tipo           = $endereco->tipo;
        $statement->bind_param("sssss", $idUsuario, $cep, $lougradouro, $bairro, $cidade, $estado, $tipo);
        $resultado      = $statement->execute();
        $statement->close();
        return $resultado != 0 ? true : false;
    }

    public function deletar($endereco){
        $query      = "delete from endereco where id = ?";
        $statement  = $this->conexao->prepare($query);
        $id         = $endereco->id;
        $statement->bind_param("i", $id);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }

    public function atualizar($endereco){
        $query      = "update endereco set cep=?, lougradouro=?, bairro=?, cidade=?, estado=? where id=?";
        $statement      = $this->conexao->prepare($query);
        $id             = $endereco->id;
        $cep            = $endereco->cep;
        $lougradouro    = $endereco->lougradouro;
        $bairro         = $endereco->bairro;
        $cidade         = $endereco->cidade;
        $estado         = $endereco->estado;
        $statement->bind_param("sssssi", $cep, $lougradouro, $bairro, $cidade, $estado, $id);
        $statement->execute();
        $resultado  = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $resultado;
    }
}

?>