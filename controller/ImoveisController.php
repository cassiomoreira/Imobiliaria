<?php

require_once("../dao/ImoveisDAO.php");

class ImoveisController {

    private $imoveisDAO;

    public function __construct() {
        $this->imoveisDAO = new ImoveisDAO();
    }

    public function Cadastrar(Imoveis $imoveis) {
        if (strlen($imoveis->getNome_prop()) > 1 && strlen($imoveis->getTelefone()) >= 8 && strlen($imoveis->getTelefone()) <= 13
                && $imoveis->getTipo_imovel() >= 1 && $imoveis->getTipo_imovel() <= 6 && $imoveis->getTipo() >= 1
                && $imoveis->getTipo() <= 2 && strlen($imoveis->getCidade()) >= 1 && strlen($imoveis->getBairro()) >= 1
                && strlen($imoveis->getRua()) >= 1){
            return $this->imoveisDAO->Cadastrar($imoveis);
        } else {
            echo "Erro ao cadastrar. ImoveisController/Cadastrar";
            return false;
        }
    }

    public function Alterar(Imoveis $imoveis) {
        if (strlen($imoveis->getNome_prop()) > 1 && strlen($imoveis->getTelefone()) >= 8 && strlen($imoveis->getTelefone()) <= 13
                && $imoveis->getTipo_imovel() >= 1 && $imoveis->getTipo_imovel() <= 6 && $imoveis->getTipo() >= 1
                && $imoveis->getTipo() <= 2 && strlen($imoveis->getCidade()) >= 1 && strlen($imoveis->getBairro()) >= 1
                && strlen($imoveis->getRua()) >= 1 && $imoveis->getId_imovel() > 0){
            return $this->imoveisDAO->Alterar($imoveis);
        } else {
            echo "Erro ao alterar. ImoveisController/Alterar";
            return false;
        }
    }

    public function RetornaId_imovel(int $id_imovel) {
        if ($id_imovel > 0) {
            return $this->imoveisDAO->RetornaId_imovel($id_imovel);
        } else {
            return null;
        }
    }

  
    public function RetornarImoveis(string $termo, int $tipo) {
        if ($termo != "" && $tipo >= 1 && $tipo <= 4) {
            return $this->imoveisDAO->RetornarImoveis($termo, $tipo);
        } else {
            return null;
        }
    }
/* 
    public function AutenticarImovelPainel(string $email, string $senha) {

        if (strpos($email, "@") && strpos($email, ".") && strlen($senha) >= 7) { //alterado!!!!!!!!! So tinha sinha
            $senha = md5($senha);
            return $this->imoveisDAO->AutenticarImovelPainel($email, $senha);
        } else {
            echo "Erro ao autenticar. ImoviesController/AutenticarImovelPainel";
            return false;
        }
    }

    public function AlterarSenha(string $senha, int $id_imovel) {
        if (strlen($senha) >= 7 && $id_imovel > 0) {
            return $this->imoveisDAO->AlterarSenha($senha, $id_imovel);
        } else {
            return false;
        }
    }
*/
}
