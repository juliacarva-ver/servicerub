<?php

include_once "config/conexao.php";

class Solicitacao
{

    private $id;
    private $cliente_id;
    private $descricao_problema;
    private $data_preferida;
    private $status;
    private $data_cad;
    private $data_atualizacao;
    private $data_resposta;
    private $resposta_admin;
    private $endereco;
    private $pdo;

public function __construct()
    {
        $this->pdo = obterPdo();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getCliente_id()
    {
        return $this->cliente_id;
    }
    public function setcliente_id(string $cliente_id)
    {
        $this->cliente_id= $cliente_id;
    }
    public function getDescricao_problema()
    {
        return $this->descricao_problema;
    }
    public function setDescricao_problema(string $descricao_problema)
    {
        $this->descricao_problema = $descricao_problema;
    }
    public function getData_preferida()
    {
        return $this->data_preferida;
    }
    public function setData_preferida(string $data_preferida)
    {
        $this->data_preferida= $data_preferida;
    } 

public function getStatus()
    {
        return $this->status;
    }
    public function setStatus(string $status)
    {
        $this->status= $status;
    }
    public function getData_cad()
    {
        return $this->data_cad;
    }
    public function setData_cad(string $data_cad)
    {
        $this->data_cad = $data_cad;
    }
    public function getData_atualizacao()
    {
        return $this->data_atualizacao;
    }
    public function setData_atualizacao(string $data_atualizacao)
    {
        $this->data_atualizacao= $data_atualizacao;
    } 

    public function getData_resposta()
    {
        return $this->data_resposta;
    }
    public function setData_resposta(string $data_resposta)
    {
        $this->data_resposta= $data_resposta;
    }
    public function getResposta_admin()
    {
        return $this->resposta_admin;
    }
    public function setResposta_admin(string $resposta_admin)
    {
        $this->resposta_admin = $resposta_admin;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }
    public function setEndereco(string $endereco)
    {
        $this->endereco= $endereco;
    } 

     public function inserir():bool{
$sql = "INSERT solicitacao (id, cliente_id, descricao_problema, data_preferida, status, data_cad, data_atualizacao, data_resposta, resposta_admin, endereco)
            values (:cliente_id, :id, :descricao_problema, :data_preferida, :status,  :data_cad, :data_atualizacao, :data_resposta, :resposta_admin, :endereco )";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id);
            $cmd->bindValue(":cliente_id", $this->cliente_id);
            $cmd->bindValue(":descricao_problema", $this->descricao_problema);
            $cmd->bindValue(":data_preferida", $this->data_preferida);
            
            if($cmd->execute()){
                $this->id = $this->pdo->lastInsertId();
                return true;
 
            }
            return true;
 
        }



















}
