<?php
require_once '../model/Endereco.php';
require_once '../database/EnderecoDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $conexao = FactoryDatabase::get();
    try {
        $enderecoDAO    = new EnderecoDAO($conexao);
        $resultado      = null;
        if ( isset($_GET["cep"]) ){
            $endereco = new Endereco();
            $endereco->cep = DataFilter::filter($_GET["cep"]);
            $resultado = $enderecoDAO->lerPorCep($endereco);
        } elseif ( isset($_GET["id"]) ) {
            $endereco = new Endereco();
            $endereco->id = DataFilter::filter($_GET["id"]);
            $resultado = $enderecoDAO->lerPorId($endereco);
        } else {
            $resultado = $enderecoDAO->ler();
        }
        FactoryDatabase::close($conexao);
        echo json_encode($resultado);
    } catch(Exeption $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }  
}

?>