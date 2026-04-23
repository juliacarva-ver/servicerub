<?php

include_once "config/conexao.php";

class Servico
{

    private $id;
    private $nome;
    private $descricao;
    private $preco;
     private $descontinuado;
    private $pdo;

public function __construct()
    {
        $this->pdo = obterPdo();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setnome(string $nome)
    {
        $this->nome= $nome;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }
    public function getPreco()
    {
        return $this->preco;
    }
    public function setPreco(string $preco)
    {
        $this->preco = $preco;
    }

    public function inserir():bool{
$sql = "INSERT servico (id, nome, descricao, preco, descontinuado)
            values (:nome, :id, :descricao, :descontinuado)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":nome", $this->nome);
            $cmd->bindValue(":id", $this->id);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":descontinuado", $this->descontinuado);
            if($cmd->execute()){
                $this->id = $this->pdo->lastInsertId();
                return true;
 
            }
            return true;
 
        }

         public function atualizar(): bool
    {
        if (!$this->id) return false;
 
        $sql = "UPDATE clientes
                    set id = :usuario_id, nome = :nome, descricao = :descricao, descontinuado = :descontinuado,
            WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":descontinuado", $this->descontinuado);
        return $cmd->execute();
    }
 
    
    public static function listar(): array
    {
        $cmd = obterPdo()->query("select * from clientes order by id desc");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
    }
    
