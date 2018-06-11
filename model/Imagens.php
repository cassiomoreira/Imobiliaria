<?php

require_once("Imoveis.php");

class Imagens{
    private $id_imagem;
    private $imagem;
    private $tb_imoveis_id_imovel;
    
    public function __construct(){
        $this->tb_imoveis_id_imovel = new Imoveis();
    }
    
    function getId_imagem() {
        return $this->id_imagem;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getTb_imoveis_id_imovel() {
        return $this->tb_imoveis_id_imovel;
    }

    function setId_imagem($id_imagem) {
        $this->id_imagem = $id_imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setTb_imoveis_id_imovel($tb_imoveis_id_imovel) {
        $this->tb_imoveis_id_imovel = $tb_imoveis_id_imovel;
    }

}