<?php

require_once("Banco.php");

class ClienteDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Cliente $cliente) {
        try {
            $sql = "INSERT INTO tb_cliente (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)";
            $param = array(
                ":nome" => $cliente->getNome(),
                ":email" => $cliente->getEmail(),
                ":telefone" => $cliente->getTelefone(),
                ":senha" => $cliente->getSenha(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Alterar(Cliente $cliente) {
        try {
            $sql = "UPDATE tb_cliente SET nome = :nome, email = :email, telefone = :telefone WHERE id_cliente = :id_cliente";
            $param = array(
                ":nome" => $cliente->getNome(),
                ":email" => $cliente->getEmail(),
                ":telefone" => $cliente->getTelefone(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarCliente(string $termo, int $tipo) {
        try {
            $sql = "";

            switch ($tipo) {
                case 1:
                    $sql = "SELECT id_cliente, nome, email FROM tb_cliente WHERE nome LIKE :termo ORDER BY nome ASC";
                    break;
                case 2:
                    $sql = "SELECT id_cliente, nome, email FROM tb_cliente WHERE email LIKE :termo ORDER BY nome ASC";
                    break;
            }

            $param = array(
                ":termo" => "%{$termo}%"
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaCliente = [];

            foreach ($dataTable as $resultado) {
                $cliente = new Cliente();

                $cliente->setId_cliente($resultado["id_cliente"]);
                $cliente->setNome($resultado["nome"]);
                $cliente->setEmail($resultado["email"]);

                $listaCliente[] = $cliente;
            }

            return $listaCliente;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornaId_Cliente(int $clienteId_cliente) {
        try {
            $sql = "SELECT nome, email, telefone FROM tb_cliente WHERE id_cliente = :id_cliente";
            $param = array(
                ":id_cliente" => $clienteId_cliente
            );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $cliente = new Cliente();

                $cliente->setNome($dt["nome"]);
                $cliente->setEmail($dt["email"]);
                $cliente->setTelefone($dt["telefone"]);

                return $cliente;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function AutenticarClientePainel(string $email, string $senha) {
        try {
            $sql = "SELECT id_cliente, email, senha FROM tb_cliente WHERE senha = :senha AND email = :email";
            $param = array(
                ":email" => $email,
                ":senha" => $senha,
            );
            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            
            if($dt != null){
                $cliente = new Cliente();
                
                $cliente->setId_cliente($dt["id_cliente"]);
                $cliente->setEmail($dt["email"]);
                $cliente->setSenha($dt["senha"]);
                
                return $cliente;
            }else{
                return null;
            }
            
        } catch (Exception $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

}

?>