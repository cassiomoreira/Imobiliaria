<?php

require_once("Banco.php");

class ImoveisDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Imoveis $imoveis) {
        try {
             $sql = "INSERT INTO tb_imoveis (nome_prop, telefone, tipo_imovel, tipo, valor, descricao, imagem, cidade, bairro, rua, numero) VALUES (:nome_prop, :telefone, :tipo_imovel, :tipo, :valor, :descricao, :imagem, :cidade, :bairro, :rua, :numero)";
            $param = array(
                ":nome_prop" => $imoveis->getNome_prop(),
                ":telefone" => $imoveis->getTelefone(),
                ":tipo_imovel" => $imoveis->getTipo_imovel(),
                ":tipo" => $imoveis->getTipo(),
                ":valor" => $imoveis->getValor(),
                ":descricao" => $imoveis->getDescricao(),
                ":imagem" => $imoveis->getImagem(),
                ":cidade" => $imoveis->getCidade(),
                ":bairro" => $imoveis->getBairro(),
                ":rua" => $imoveis->getRua(),
                ":numero" => $imoveis->getNumero()
            );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: ImoveisDAO/Cadastrar";
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }
    

    public function Alterar(Imoveis $imoveis) {
        try {
            $sql = "UPDATE tb_imoveis SET nome_prop = :nome_prop, telefone = :telefone, tipo_imovel = :tipo_imovel, tipo = :tipo, valor = :valor, descricao = :descricao, cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero WHERE id_imovel = :id_imovel";
            $param = array(
                ":nome_prop" => $imoveis->getNome_prop(),
                ":telefone" => $imoveis->getTelefone(),
                ":tipo_imovel" => $imoveis->getTipo_imovel(),
                ":tipo" => $imoveis->getTipo(),
                ":valor" => $imoveis->getValor(),
                ":descricao" => $imoveis->getDescricao(),
                ":cidade" => $imoveis->getCidade(),
                ":bairro" => $imoveis->getBairro(),
                ":rua" => $imoveis->getRua(),
                ":numero" => $imoveis->getNumero()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "Erro na ImoveisDAO/Alterar";
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarImoveis(string $termo, int $tipo) {
        try {
            $sql = "";

            switch ($tipo) {
                case 1:
                    $sql = "SELECT id_imovel, nome_prop, cidade, bairro FROM tb_imoveis WHERE nome_prop LIKE :termo ORDER BY nome_prop ASC";
                    break;
                case 2:
                    $sql = "SELECT id_imovel, nome_prop, cidade, bairro FROM tb_imoveis WHERE cidade LIKE :termo ORDER BY cidade ASC";
                    break;
                case 3:
                    $sql = "SELECT id_imovel, nome_prop, cidade, bairro FROM tb_imoveis WHERE bairro LIKE :termo ORDER BY bairro ASC";
                    break;
            }

            $param = array(
                ":termo" => "%{$termo}%"
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaImoveis = [];

            foreach ($dataTable as $resultado) {
                $imovies = new Imoveis();

                $imovies->setId_imovel($resultado["id_imovel"]);
                $imovies->setNome_prop($resultado["nome_prop"]);
                $imovies->setCidade($resultado["cidade"]);
                $imovies->setBairro($resultado["bairro"]);

                $listaImoveis[] = $imovies;
            }

            return $listaImoveis;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "Erro: O erro está em: ImoveisDAO/RetornarImoveis";
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornaId_imovel(int $id_imovel) {
        try {
            $sql = "SELECT $id_imovel, nome_prop, telefone, tipo_imovel, tipo, valor, descricao, cidade, bairro, rua, numero FROM tb_imoveis WHERE id_imovel = :id_imovel";
            $param = array( ":id_imovel" => $id_imovel );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $imoveis = new Imoveis();

                $imoveis->setNome_prop($dt["nome_prop"]);
                $imoveis->setTelefone($dt["telefone"]);
                $imoveis->setTipo_imovel($dt["tipo_imovel"]);
                $imoveis->setTipo($dt["tipo"]);
                $imoveis->setValor($dt["valor"]);
                $imoveis->setDescricao($dt["descricao"]);
                $imoveis->setCidade($dt["cidade"]);
                $imoveis->setBairro($dt["bairro"]);
                $imoveis->setRua($dt["rua"]);
                $imoveis->setNumero($dt["numero"]);  

                return $imoveis;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            if ($this->debug) {
                echo "Erro: O erro está em: ImoveisDAO/RetornaId_imovel";
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    
    
    /*
    public function AlterarSenha(string $senha, int $id_cliente) {
        try {
            $sql = "UPDATE tb_imoveis SET senha = :senha WHERE id_imovel = :id_imovel";
            $param = array(
                ":senha" => md5($senha),
                ":id_cliente" => $id_imovel
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
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

            if ($dt != null) {
                $cliente = new Cliente();

                $cliente->setId_cliente($dt["id_cliente"]);
                $cliente->setEmail($dt["email"]);
                $cliente->setSenha($dt["senha"]);

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
    }*/
}

?>


