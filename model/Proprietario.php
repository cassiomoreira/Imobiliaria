<?php

require_once("Imoveis.php");

class Proprietario{
    private $nome;
    private $telefone;
    private $tb_imoveis_id_imovel;
    
    public function __construct(){
        $this->tb_imoveis_id_imovel = new Imoveis();
    }
    
    function getNome() {
        return $this->nome;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getTb_imoveis_id_imovel() {
        return $this->tb_imoveis_id_imovel;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setTb_imoveis_id_imovel($tb_imoveis_id_imovel) {
        $this->tb_imoveis_id_imovel = $tb_imoveis_id_imovel;
    }


}