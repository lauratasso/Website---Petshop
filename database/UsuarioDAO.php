<?php

require_once '../model/Usuario.php';

class UsuarioDAO {
    private $conexao;

    public function __construct(&$conexao){
        $this->conexao = $conexao;
    }
    
    public function existePorEmailESenha($usuario){
        $query                      = "select id, cpf, nome, email, senha, telefone, dataNascimento, profissao, cepEntrega, lougradouroEntrega, numeroEntrega, bairroEntrega, cidadeEntrega, estadoEntrega, cepResidencial, lougradouroResidencial, numeroResidencial, bairroResidencial, cidadeResidencial, estadoResidencial from usuario where email = ? and senha = ?";
        $statement                  = $this->conexao->prepare($query);
        $statement->bind_param("ss", $usuario->email, $usuario->senha);
        $statement->execute();
        $statement->store_result();
        $resultado = $statement->num_rows > 0  ? true : false;
        $statement->close();
        return $resultado;

    }

    
    public function lerPorId($usuario){
        $query                      = "select iid, cpf, nome, email, senha, telefone, dataNascimento, profissao, cepEntrega, lougradouroEntrega, numeroEntrega, bairroEntrega, cidadeEntrega, estadoEntrega, cepResidencial, lougradouroResidencial, numeroResidencial, bairroResidencial, cidadeResidencial, estadoResidencial from usuario where id = ?";
        $statement                  = $this->conexao->prepare($query);
        $statement->bind_param("i", $usuario->id);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result(
            $id,
            $cpf,
            $nome,
            $email,
            $senha,
            $telefone,
            $dataNascimento,
            $profissao,
            $cepEntrega,
            $lougradouroEntrega,
            $numeroEntrega,
            $bairroEntrega,
            $cidadeEntrega,
            $estadoEntrega,
            $cepResidencial,
            $lougradouroResidencial,
            $numeroResidencial,
            $bairroResidencial,
            $cidadeResidencial,
            $estadoResidencial
        );

        $statement->fetch();
        $usuario                            = new Usuario();
        $usuario->id                        = $id;
        $usuario->cpf                       = $cpf;
        $usuario->nome                      = $nome;
        $usuario->email                     = $email;
        $usuario->senha                     = $senha;
        $usuario->telefone                  = $telefone;
        $usuario->dataNascimento            = $dataNascimento;
        $usuario->profissao                 = $profissao;
        $usuario->cepEntrega               = $cepEntrega;
        $usuario->lougradouroEntrega        = $lougradouroEntrega;
        $usuario->numeroEntrega             = $numeroEntrega;
        $usuario->bairroEntrega             = $bairroEntrega;
        $usuario->cidadeEntrega             = $cidadeEntrega;
        $usuario->estadoEntrega             = $estadoEntrega;
        $usuario->cepResidencial           = $cepResidencial;
        $usuario->lougradouroResidencial    = $lougradouroResidencial;
        $usuario->numeroResidencial         = $numeroResidencial;
        $usuario->bairroResidencial         = $bairroResidencial;
        $usuario->cidadeResidencial         = $cidadeResidencial;
        $usuario->estadoResidencial         = $estadoResidencial;
        $statement->close();
        return $usuario;
    }

    public function lerPorEmailESenha($usuario){
        $query                      = "select id, cpf, nome, email, senha, telefone, dataNascimento, profissao, cepEntrega, lougradouroEntrega, numeroEntrega, bairroEntrega, cidadeEntrega, estadoEntrega, cepResidencial, lougradouroResidencial, numeroResidencial, bairroResidencial, cidadeResidencial, estadoResidencial from usuario where email = ? and senha = ?";
        $statement                  = $this->conexao->prepare($query);
        $statement->bind_param("ss", $usuario->email, $usuario->senha);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $cpf, $nome, $email, $senha, $telefone, $dataNascimento, $profissao, $cepEntrega, $lougradouroEntrega, $numeroEntrega, $bairroEntrega, $cidadeEntrega, $estadoEntrega, $cepResidencial, $lougradouroResidencial, $numeroResidencial, $bairroResidencial, $cidadeResidencial, $estadoResidencial );
        $statement->fetch();
        $usuario                            = new Usuario();
        $usuario->id                        = $id;
        $usuario->cpf                       = $cpf;
        $usuario->nome                      = $nome;
        $usuario->email                     = $email;
        $usuario->senha                     = $senha;
        $usuario->telefone                  = $telefone;
        $usuario->dataNascimento            = $dataNascimento;
        $usuario->profissao                 = $profissao;
        $usuario->cepEntrega                = $cepEntrega;
        $usuario->lougradouroEntrega        = $lougradouroEntrega;
        $usuario->numeroEntrega             = $numeroEntrega;
        $usuario->bairroEntrega             = $bairroEntrega;
        $usuario->cidadeEntrega             = $cidadeEntrega;
        $usuario->estadoEntrega             = $estadoEntrega;
        $usuario->cepResidencial            = $cepResidencial;
        $usuario->lougradouroResidencial    = $lougradouroResidencial;
        $usuario->numeroResidencial         = $numeroResidencial;
        $usuario->bairroResidencial         = $bairroResidencial;
        $usuario->cidadeResidencial         = $cidadeResidencial;
        $usuario->estadoResidencial         = $estadoResidencial;
        $statement->close();
        return $usuario;
    }

    public function ler(){
        $query      = "select id, cpf, nome, email, senha, telefone, dataNascimento, profissao, cepEntrega, lougradouroEntrega, numeroEntrega, bairroEntrega, cidadeEntrega, estadoEntrega, cepResidencial, lougradouroResidencial, numeroResidencial, bairroResidencial, cidadeResidencial, estadoResidencial from usuario";
        $statement  = $this->conexao->prepare($query);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($id, $cpf, $nome, $email, $senha, $telefone, $dataNascimento, $profissao, $cepEntrega, $lougradouroEntrega, $numeroEntrega, $bairroEntrega, $cidadeEntrega, $estadoEntrega, $cepResidencial, $lougradouroResidencial, $numeroResidencial, $bairroResidencial, $cidadeResidencial, $estadoResidencial );
        $usuarios   = array();
        while ( $statement->fetch() ){
            $usuario                            = new Usuario();
            $usuario->id                        = $id;
            $usuario->cpf                       = $cpf;
            $usuario->nome                      = $nome;
            $usuario->email                     = $email;
            $usuario->senha                     = $senha;
            $usuario->telefone                  = $telefone;
            $usuario->dataNascimento            = $dataNascimento;
            $usuario->profissao                 = $profissao;
            $usuario->cepEntrega                = $cepEntrega;
            $usuario->lougradouroEntrega        = $lougradouroEntrega;
            $usuario->numeroEntrega             = $numeroEntrega;
            $usuario->bairroEntrega             = $bairroEntrega;
            $usuario->cidadeEntrega             = $cidadeEntrega;
            $usuario->estadoEntrega             = $estadoEntrega;
            $usuario->cepResidencial            = $cepResidencial;
            $usuario->lougradouroResidencial    = $lougradouroResidencial;
            $usuario->numeroResidencial         = $numeroResidencial;
            $usuario->bairroResidencial         = $bairroResidencial;
            $usuario->cidadeResidencial         = $cidadeResidencial;
            $usuario->estadoResidencial         = $estadoResidencial;
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public function criar($usuario){
        $query                      = "insert into usuario(cpf, nome, email, senha, telefone, dataNascimento, profissao, cepEntrega, lougradouroEntrega, numeroEntrega, bairroEntrega, cidadeEntrega, estadoEntrega, cepResidencial, lougradouroResidencial, numeroResidencial, bairroResidencial, cidadeResidencial, estadoResidencial) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement                  = $this->conexao->prepare($query);
        $cpf                        = $usuario->cpf;
        $nome                       = $usuario->nome;
        $email                      = $usuario->email;
        $senha                      = $usuario->senha;
        $telefone                   = $usuario->telefone;
        $dataNascimento             = $usuario->dataNascimento;
        $profissao                  = $usuario->profissao;
        $cepEntrega                 = $usuario->cepEntrega;
        $lougradouroEntrega         = $usuario->lougradouroEntrega;
        $numeroEntrega              = $usuario->numeroEntrega;
        $bairroEntrega              = $usuario->bairroEntrega;
        $cidadeEntrega              = $usuario->cidadeEntrega;
        $estadoEntrega              = $usuario->estadoEntrega;
        $cepResidencial             = $usuario->cepResidencial;
        $lougradouroResidencial     = $usuario->lougradouroResidencial;
        $numeroResidencial          = $usuario->numeroResidencial;
        $bairroResidencial          = $usuario->bairroResidencial;
        $cidadeResidencial          = $usuario->cidadeResidencial;
        $estadoResidencial          = $usuario->estadoResidencial;
        $statement->bind_param("sssssssssssssssssss", $cpf, $nome, $email, $senha, $telefone, $dataNascimento, $profissao, $cepEntrega, $lougradouroEntrega, $numeroEntrega, $bairroEntrega, $cidadeEntrega, $estadoEntrega, $cepResidencial, $lougradouroResidencial, $numeroResidencial, $bairroResidencial, $cidadeResidencial, $estadoResidencial);
        $result                     = $statement->execute();
        $statement->close();
        return $result != 0 ? true : false;
    }

    public function deletar($usuario){
        $query      = "delete from usuario where id = ?";
        $statement  = $this->conexao->prepare($query);
        $statement->bind_param("i", $usuario->id);
        $statement->execute();
        $result     = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $result;
    }

    public function atualizar($usuario){
        $query                      = "update usuario set cpf=?, nome=?, email=?, senha=?, telefone=?, dataNascimento=?, profissao=?, cepEntrega=?, lougradouroEntrega=?, numeroEntrega=?, bairroEntrega=?, cidadeEntrega=?, estadoEntrega=?, cepResidencial=?, lougradouroResidencial=?, numeroResidencial=?, bairroResidencial=?, cidadeResidencial=?, estadoResidencial=? where id = ?";
        $statement                  = $this->conexao->prepare($query);
        $id                         = $usuario->id;
        $cpf                        = $usuario->cpf;
        $nome                       = $usuario->nome;
        $email                      = $usuario->email;
        $senha                      = $usuario->senha;
        $telefone                   = $usuario->telefone;
        $dataNascimento             = $usuario->dataNascimento;
        $profissao                  = $usuario->profissao;
        $cepEntrega                 = $usuario->cepEntrega;
        $lougradouroEntrega         = $usuario->lougradouroEntrega;
        $numeroEntrega              = $usuario->numeroEntrega;
        $bairroEntrega              = $usuario->bairroEntrega;
        $cidadeEntrega              = $usuario->cidadeEntrega;
        $estadoEntrega              = $usuario->estadoEntrega;
        $cepResidencial             = $usuario->cepResidencial;
        $lougradouroResidencial     = $usuario->lougradouroResidencial;
        $numeroResidencial          = $usuario->numeroResidencial;
        $bairroResidencial          = $usuario->bairroResidencial;
        $cidadeResidencial          = $usuario->cidadeResidencial;
        $estadoResidencial          = $usuario->estadoResidencial;
        $statement->bind_param("sssssssssssssssssssi",$cpf,$nome,$email,$senha,$telefone,$dataNascimento,$profissao,$cepEntrega,$lougradouroEntrega,$numeroEntrega,$bairroEntrega,$cidadeEntrega,$estadoEntrega,$cepResidencial,$lougradouroResidencial,$numeroResidencial,$bairroResidencial,$cidadeResidencial,$estadoResidencial,$id);
        $statement->execute();
        $result                     = $statement->affected_rows == 1 ? true : false;
        $statement->close();
        return $result;
    }
}

?>