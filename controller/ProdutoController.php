<?php
require_once '../model/Produto.php';
require_once '../database/ProdutoDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php'; 

if( $_SERVER["REQUEST_METHOD"] == "GET" ){
    $conexao = FactoryDatabase::get();
    try {
        $produtoDAO = new ProdutoDAO($conexao);
        $resultado = null;
        if ( isset($_GET["id"]) ){
            $id             = DataFilter::filter($_GET["id"]);
            $produto        = new Produto();
            $produto->id    = $id;
            $resultado      = $produtoDAO->lerPorId($produto);
        } elseif ( isset($_GET["imagem"]) ){
            $arquivo        = "../database/images/" . DataFilter::filter($_GET["imagem"]);
            $manipulador    = fopen($arquivo, "rb");
            $imagem         = fread($manipulador, filesize($arquivo));
            fclose($manipulador);
            header("content-type: image/jpeg");
            echo $imagem;
        }elseif ( isset($_GET["descricao"]) ){
            $descricao          = DataFilter::filter($_GET["descricao"]);
            $produto            = new Produto();
            $produto->descricao = $descricao;
            $resultado          = $produtoDAO->lerPorDescricao($produto);
        } elseif( isset($_GET["recentes"]) ){
            $resultado          = $produtoDAO->lerRecentes();
        }else {
            $resultado = $produtoDAO->ler();
        }
        FactoryDatabase::close($conexao);
        echo json_encode($resultado);
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
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
        $produto = new Produto();
        if ( isset($_POST["nome"]) )
            $produto->nome = DataFilter::filter($_POST["nome"]);
        if ( isset($_POST["fabricante"]) )
            $produto->fabricante = DataFilter::filter($_POST["fabricante"]);
        if ( isset($_POST["descricao"]) )
            $produto->descricao = DataFilter::filter($_POST["descricao"]);
        if ( isset($_POST["preco-venda"]) )
            $produto->precoVenda = DataFilter::filter($_POST["preco-venda"]);
        if ( isset($_POST["quantidade"]) )
            $produto->quantidade = DataFilter::filter($_POST["quantidade"]);
        if ( isset($_POST["quantidade"]) )
            $produto->quantidade = DataFilter::filter($_POST["quantidade"]);
        if( isset($_FILES['imagem']) ){
            $extensao           = strtolower(substr($_FILES['imagem']['name'], -4));
            $imagem             = md5(time()) . $extensao;
            $diretorio          = "../database/images/";
            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $imagem);
            $produto->imagem    = $imagem;
        }   
        $produtoDAO = new ProdutoDAO($conexao);
        $produtoDAO->criar($produto);
        FactoryDatabase::close($conexao);
        return "CRIADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }  
}

function atualizar(){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($_POST["id"]) )
            throw new Exception("Id do produto deve ser fornecido");
        $produto = new Produto();
        $produto->id = DataFilter::filter($_POST["id"]);
        if ( isset($_POST["nome"]) )
            $produto->nome = DataFilter::filter($_POST["nome"]);
        if ( isset($_POST["fabricante"]) )
            $produto->fabricante = DataFilter::filter($_POST["fabricante"]);
        if ( isset($_POST["descricao"]) )
            $produto->descricao = DataFilter::filter($_POST["descricao"]);
        if ( isset($_POST["precoVenda"]) )
            $produto->precoVenda = DataFilter::filter($_POST["preco-venda"]);
        if ( isset($_POST["quantidade"]) )
            $produto->quantidade = DataFilter::filter($_POST["quantidade"]);
        if( isset($_FILES['imagem']) ){
            $extensao           = strtolower(substr($_FILES['imagem']['name'], -4));
            $imagem             = md5(time()) . $extensao;
            $diretorio          = "../database/images/";
            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $imagem);
            $produto->imagem    = $imagem;
        }
        $produtoDAO = new ProdutoDAO($conexao);
        $produtoDAO->atualizar($produto);
        FactoryDatabase::close($conexao);
        return "ATUALIZADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
}

function deletar(){
    $conexao = FactoryDatabase::get();
    try {
        if ( ! isset($_POST["id"]) )
            throw new Exception("Id do produto deve ser fornecido"); 
        $produto = new Produto();
        $produto->id = DataFilter::filter($_POST["id"]);
        $produtoDAO = new ProdutoDAO($conexao);
        $produtoDAO->deletar($produto);
        FactoryDatabase::close($conexao);
        return "DELETADO";
    } catch(Exception $e){
        FactoryDatabase::close($conexao);
        return $e->getMessage();
    }
    
}

?>