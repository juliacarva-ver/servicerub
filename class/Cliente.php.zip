<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "config/conexao.php";

class Cliente
{

    private $id;
    private $usuario_id;
    private $telefone;
    private $cpf;
    private $pdo;

    public function __construct()
    {
        $this->pdo = obterPdo();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }
    public function setUsuario_id(string $usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function inserir(): bool
    {
        $sql = "INSERT usuarios (id, telefone, cpf, usuario_id)
            values (:id, :telefone :cpf, :usuario_id )";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":telefone", $this->telefone);
        $cmd->bindValue(":usuario_id", $this->usuario_id);
        $cmd->bindValue(":cpf", $this->cpf);

        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return true;
    }

  
    public function atualizar(): bool
    {
        if (!$this->id) return false;
 
        $sql = "UPDATE clientes
                    set usuario_id = :usuario_id, telefone = :telefone, cpf = :cpf,
            WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":usuario_id", $this->usuario_id);
        $cmd->bindValue(":telefone", $this->telefone);
        $cmd->bindValue(":cpf", $this->cpf);
        return $cmd->execute();
    }
 
    
    public static function listar(): array
    {
        $cmd = obterPdo()->query("select * from clientes order by id desc");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
 
 
 
    public function buscarPorId(int $id): bool
    {
        $sql = "SELECT * FROM  clientes WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];
            $this->setUsuario_id($dados['usuario_id']);
            $this->setTelefone($dados['telefone']);
            $this->setCpf($dados['cpf']);
            return true;
        }
        return false;
    }
 
       
 
     public function buscarPorUsuario(int $usuario_id): bool
    {
        $sql = "SELECT * FROM  usuario";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":usuario", $usuario_id);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];
            $this->setUsuario_id($dados['usuario_id']);
            $this->setTelefone($dados['telefone']);
            $this->setCpf($dados['cpf']);
            return true;
        }
        return false;
    }
 



}

