<?php

require_once("../dao/ClienteDAO.php");

class ClienteController {

    private $clienteDAO;

    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
    }

    public function Cadastrar(Cliente $cliente) {
        if (strlen($cliente->getNome()) >= 4 && strpos($cliente->getEmail(), "@") && strpos($cliente->getEmail(), ".") && strlen($cliente->getSenha()) >= 7) {
            return $this->clienteDAO->Cadastrar($cliente);
        } else {
            echo "Erro ao cadastrar. ClienteController/Cadastrar";
            return false;
        }
    }

    public function Alterar(Cliente $cliente) {
        if (strlen($cliente->getNome()) >= 4 && strpos($cliente->getEmail(), "@") && strpos($cliente->getEmail(), ".")) {
            return $this->clienteDAO->Alterar($cliente);
        } else {
            echo "Erro ao alterar. ClienteController/Alterar";
            return false;
        }
    }

    public function RetornarCliente(string $termo, int $tipo) {
        if ($termo != "" && $tipo >= 1 && $tipo <= 4) {
            return $this->clienteDAO->RetornarCliente($termo, $tipo);
        } else {
            return null;
        }
    }

    public function RetornaId_cliente(int $clienteId_cliente) {
        if ($clienteId_cliente > 0) {
            return $this->clienteDAO->RetornaId_cliente($clienteId_cliente);
        } else {
            return null;
        }
    }

    public function AutenticarClientePainel(string $email, string $senha) {

        if (strpos($email, "@") && strpos($email, ".") && strlen($senha) >= 7) { //alterado!!!!!!!!! So tinha senha
            $senha = md5($senha);
            return $this->clienteDAO->AutenticarClientePainel($email, $senha);
        } else {
            echo "Erro ao autenticar. ClienteController/AutenticarClientePainel";
            return false;
        }
    }

    public function AlterarSenha(string $senha, int $id_cliente) {
        if (strlen($senha) >= 7 && $id_cliente > 0) {
            return $this->clienteDAO->AlterarSenha($senha, $id_cliente);
        } else {
            return false;
        }
    }

}
