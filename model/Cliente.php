<?php

class Cliente{
    
    private $id_cliente;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    
    function setNome($nome){
        $this->nome = $nome;
    }
    function getNome(){
        return $this->nome;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function getSenha() {
        return $this->senha;
    }

    function setSenha($senha) {
        $this->senha = md5($senha); // md5($senha);
    }
    
    function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    
    function getTelefone(){
        return $this->telefone;
    }
    
    function getId_cliente() {
        return $this->id_cliente;
    }
    
    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }
}

?>