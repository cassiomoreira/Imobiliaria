<?php

class Imoveis{
    private $id_imovel;
    private $Codigo_imovel;
    private $valor_imovel;
    private $valor_venda;
    private $aluguel;
    private $venda;
    private $tipo_imovel;
    
    function getId_imovel() {
        return $this->id_imovel;
    }

    function getCodigo_imovel() {
        return $this->Codigo_imovel;
    }

    function getValor_imovel() {
        return $this->valor_imovel;
    }

    function getValor_venda() {
        return $this->valor_venda;
    }

    function getAluguel() {
        return $this->aluguel;
    }

    function getVenda() {
        return $this->venda;
    }

    function getTipo_imovel() {
        return $this->tipo_imovel;
    
    }

    function setId_imovel($id_imovel) {
        $this->id_imovel = $id_imovel;
    }

    function setCodigo_imovel($Codigo_imovel) {
        $this->Codigo_imovel = $Codigo_imovel;
    }

    function setValor_imovel($valor_imovel) {
        $this->valor_imovel = $valor_imovel;
    }

    function setValor_venda($valor_venda) {
        $this->valor_venda = $valor_venda;
    }

    function setAluguel($aluguel) {
        $this->aluguel = $aluguel;
    }

    function setVenda($venda) {
        $this->venda = $venda;
    }

    function setTipo_imovel($tipo_imovel) {
        $this->tipo_imovel = $tipo_imovel;
    }


}

