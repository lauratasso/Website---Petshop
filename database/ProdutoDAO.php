<?php

require_once '../model/Produto.php';

class ProdutoDAO {
    private $conexao;

    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function lerPorId($produto){
        $query                  = "select id, nome, fabricante, descricao, precoVenda, quantidade, imagem, data from produto where id = ?";
        $statement              = $this->conexao->prepare($query);
        $statement->bind_param("i", $produto->id);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem, $data);
        $statement->fetch();
        $produto = new Produto();
        $produto->id            = $id;
        $produto->nome          = $nome;
        $produto->fabricante    = $fabricante;
        $produto->descricao     = $descricao;
        $produto->precoVenda    = $precoVenda;
        $produto->quantidade    = $quantidade;
        $produto->imagem        = $imagem;
        $produto->data          = $data;
        $statement->close();
        return $produto;
    }

    public function lerPorDescricao($produto){
        $query                  = "select id, nome, fabricante, descricao, precoVenda, quantidade, imagem, data from produto where lower(descricao) like '%$produto->descricao%'";
        $statement              = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem, $data);
        $produtos   = array();
        while ( $statement->fetch() ){
            $produto                = new Produto();
            $produto->id            = $id;
            $produto->nome          = $nome;
            $produto->fabricante    = $fabricante;
            $produto->descricao     = $descricao;
            $produto->precoVenda    = $precoVenda;
            $produto->quantidade    = $quantidade;
            $produto->imagem        = $imagem;
            $produto->data          = $data;
            array_push($produtos, $produto);
        }
        return $produtos;
    }

    public function lerRecentes(){
        $query                  = "select id, nome, fabricante, descricao, precoVenda, quantidade, imagem, data from produto order by data desc limit 10";
        $statement              = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem, $data);
        $produtos   = array();
        while ( $statement->fetch() ){
            $produto                = new Produto();
            $produto->id            = $id;
            $produto->nome          = $nome;
            $produto->fabricante    = $fabricante;
            $produto->descricao     = $descricao;
            $produto->precoVenda    = $precoVenda;
            $produto->quantidade    = $quantidade;
            $produto->imagem        = $imagem;
            $produto->data          = $data;
            array_push($produtos, $produto);
        }
        return $produtos;
    }

    public function ler(){
        $query      = "select id, nome, fabricante, descricao, precoVenda, quantidade, imagem, data from produto";
        $statement  = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem, $data);
        $produtos   = array();
        while ( $statement->fetch() ){
            $produto                = new Produto();
            $produto->id            = $id;
            $produto->nome          = $nome;
            $produto->fabricante    = $fabricante;
            $produto->descricao     = $descricao;
            $produto->precoVenda    = $precoVenda;
            $produto->quantidade    = $quantidade;
            $produto->imagem        = $imagem;
            $produto->data          = $data;
            array_push($produtos, $produto);
        }
        return $produtos;
    }

    public function criar($produto){
        $query          = "insert into produto(nome, fabricante, descricao, precoVenda, quantidade, imagem, data) values (?, ?, ?, ?, ?, ?, now())";
        $statement      = $this->conexao->prepare($query);
        $nome           = $produto->nome;
        $fabricante     = $produto->fabricante;
        $descricao      = $produto->descricao;
        $precoVenda     = $produto->precoVenda;
        $quantidade     = $produto->quantidade;
        $imagem         = $produto->imagem;
        $statement->bind_param("sssdis", $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem);
        $result     = $statement->execute();
        $statement->close();
        return $result != 0 ? true : false;
    }

    public function deletar($produto){
        $query      = "delete from produto where id = ?";
        $statement  = $this->conexao->prepare($query);
        $statement->bind_param("i", $produto->id);
        $statement->execute();
        $result     = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $result;
    }

    public function atualizar($produto){
        $query          = "update produto set nome=?, fabricante=?, descricao=?, precoVenda=?, quantidade=?, imagem=?, data=now() where id = ?";
        $statement      = $this->conexao->prepare($query);
        $id             = $produto->id;
        $nome           = $produto->nome;
        $fabricante     = $produto->fabricante;
        $descricao      = $produto->descricao;
        $precoVenda     = $produto->precoVenda;
        $quantidade     = $produto->quantidade;
        $imagem         = $produto->imagem;
        $statement->bind_param("sssdisi", $nome, $fabricante, $descricao, $precoVenda, $quantidade, $imagem, $id);
        $statement->execute();
        $result         = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $result;
    }
}

?>