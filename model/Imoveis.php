<?php

class Imoveis {

    private $id_imovel;
    private $nome_prop;
    private $telefone;
    private $tipo_imovel;
    private $tipo;
    private $valor;
    private $descricao;
    private $imagem;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;

    function getId_imovel() {
        return $this->id_imovel;
    }

    function getNome_prop(){
        return $this->nome_prop;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getTipo_imovel() {
        return $this->tipo_imovel;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getValor() {
        return $this->valor;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagem() {
        return $this->imagem;
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

    function setId_imovel($id_imovel) {
        $this->id_imovel = $id_imovel;
    }

    function setNome_prop($nome_prop) {
        $this->nome_prop = $nome_prop;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setTipo_imovel($tipo_imovel) {
        $this->tipo_imovel = $tipo_imovel;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
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

}
