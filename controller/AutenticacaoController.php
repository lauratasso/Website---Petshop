<?php

require_once '../model/Usuario.php';
require_once '../model/Autenticacao.php';
require_once '../database/UsuarioDAO.php';
require_once '../database/FactoryDatabase.php';
require_once '../lib/DataFilter.php';

if ( $_SERVER["REQUEST_METHOD"] == "GET" ){
    try {
        session_start();
        echo json_encode($_SESSION);
    } catch(Exeption $e){
        echo $e->getMessage();
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conexao = FactoryDatabase::get();
    try {
        session_start();
        $usuarioDAO     = new UsuarioDAO($conexao); 
        $existeUsuario  = null;
        $resultado      = null;
        $usuario        = new Usuario();
        if ( isset($_POST["email"]) && isset($_POST["senha"]) ){
            $usuario->email = DataFilter::filter($_POST["email"]);
            $usuario->senha = hash('sha512', DataFilter::filter($_POST["senha"]));
            $existeUsuario  = $usuarioDAO->existePorEmailESenha($usuario);
        }

        if ( isset($existeUsuario) && $existeUsuario == true ){
            $_SESSION["email"] = $usuario->email;
            $_SESSION["senha"] = $usuario->senha;
            $resultado = "PERMITIDO";
        } else {
            unset ($_SESSION['email']);
            unset ($_SESSION['senha']);
            $resultado = "BLOQUEADO";
        }
        FactoryDatabase::close($conexao);
        echo $resultado;
    } catch(Exeption $e){
        FactoryDatabase::close($conexao);
        echo $e->getMessage();
    }
}

if($_SERVER["REQUEST_METHOD"] == "DELETE"){
    try {
        session_start();
        session_destroy();
        echo "LOGOUT";
    } catch(Exeption $e){
        echo $e->getMessage();
    }
   
}

?>
