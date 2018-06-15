<?php

require_once("Imoveis.php");

class Divisao_espaco{
    private $id_divisao_espaco;
    private $quant_quarto;
    private $quant_banheiro;
    private $quant_cozinha;
    private $garagem;
    private $suite;
    private $varanda;
    private $churasqueira;
    private $piscina;
    private $quintal;
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

        function getId_divisao_espaco() {
        return $this->id_divisao_espaco;
    }

    function getQuant_quarto() {
        return $this->quant_quarto;
    }

    function getQuant_banheiro() {
        return $this->quant_banheiro;
    }

    function getQuant_cozinha() {
        return $this->quant_cozinha;
    }

    function getGaragem() {
        return $this->garagem;
    }

    function getSuite() {
        return $this->suite;
    }

    function getVaranda() {
        return $this->varanda;
    }

    function getChurasqueira() {
        return $this->churasqueira;
    }

    function getPiscina() {
        return $this->piscina;
    }

    function getQuintal() {
        return $this->quintal;
    }

    function setId_divisao_espaco($id_divisao_espaco) {
        $this->id_divisao_espaco = $id_divisao_espaco;
    }

    function setQuant_quarto($quant_quarto) {
        $this->quant_quarto = $quant_quarto;
    }

    function setQuant_banheiro($quant_banheiro) {
        $this->quant_banheiro = $quant_banheiro;
    }

    function setQuant_cozinha($quant_cozinha) {
        $this->quant_cozinha = $quant_cozinha;
    }

    function setGaragem($garagem) {
        $this->garagem = $garagem;
    }

    function setSuite($suite) {
        $this->suite = $suite;
    }

    function setVaranda($varanda) {
        $this->varanda = $varanda;
    }

    function setChurasqueira($churasqueira) {
        $this->churasqueira = $churasqueira;
    }

    function setPiscina($piscina) {
        $this->piscina = $piscina;
    }

    function setQuintal($quintal) {
        $this->quintal = $quintal;
    }

}

