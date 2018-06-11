<?php

require_once("Imoveis.php");

class Endereco_imoveis{
    private $id_endereco_imoveis;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $complemento;
    private $tb_imoveis_id_imovel;
    
    public function __construct(){
        $this->tb_imoveis_id_imovel = new Imoveis();
    }
    
    function getTb_imoveis_id_imovel() {
        return $this->tb_imoveis_id_imovel;
    }

    function setTb_imoveis_id_imovel($tb_imoveis_id_imovel) {
        $this->tb_imoveis_id_imovel = $tb_imoveis_id_imovel;
    }

        
    function getId_endereco_imoveis() {
        return $this->id_endereco_imoveis;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function setId_endereco_imoveis($id_endereco_imoveis) {
        $this->id_endereco_imoveis = $id_endereco_imoveis;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

}

