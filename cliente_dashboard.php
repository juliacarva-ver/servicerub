<?php 
session_start();

// inclui o arquivo de conexao com o banco de dados
require_once "config/conexao.php";


// inclui funcoes auxiliares do sistema
require_once "includes/funcoes.php";

// classe cliente
require_once "class/Cliente.php";



if(!isset($_SESSION['usuario_id']) || $_SESSION["tipo"]!=2){
   header("location: login.php");
}
  
// cria um objeto da classe cliente 
$cliente = new Cliente;

// busca os dados do cliente usando o id do usuario logado
if(!$cliente->buscarPorId($_SESSION["usuario_id"])){
  // se nao  encontrar o cliente, encerra a execucao
  die("Cliente nao encontrado");
}

// consulta sql para buscar as solicitacao do cliente
// tambem busca os servicos vinculados a cada solicitacao
$sql = "SELECT s.id,s.status,s.data_cad, GROUP_CONCAT(se.nome SEPARADOR '.')AS servicos from solicitacoes s
INNER JOIN servico_solicitacao ss ON ss.solicitacoes_id WHERE s.cliente_id=?
GROUP BY s.id, s.status, s.data_cad
ORDER BY  s.data_cad DES";

// prepara a consulta 
$stmt = $this->pdo->prepare($sql);

// execute 
$stmt->execute([$cliente["id"]]);

// busca todas as solicitacoes encontradas no banco
$solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);


include "includes/header.php";
include "includes/menu.php";
?>

<main class="container mt-5">
  <h2>Bem-vindo, <?= $_SESSION["nome"] ?></h2>
  <p><a href="logout.php" class="btn btn-danger btn-sm">Sair</a></p>
  <a href="cliente_perfil.php" class="btn btn-warning btn-sm">Meu Perfil</a>
  <h4 class="mt-4">Minhas Solicitações</h4>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Serviços</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>

    <tbody>
   <!-- percorre todas as solicitacoes retornadas do banco-->
    <?php foreach($solicitacoes as $s):?>
    <tr>
    <!-- exibe o id da solicitacao-->
     <td><?= $a["id"] ?></td>
          <td> 
            <?php 
            // divide a lista de servicos em uma array
            $lista = explode(",", $s["servicos"]);

            // percorre cada servico da solicitacao 
            foreach($lista as $nomeServico){

              //htmlspecialchars evita execucao de codigo html/js malicioso
              echo '<span class="badge bg-primary me-1 mb-1">'.htmlspecialchars($nomeServico).'</span>';
            }
            ?>
          </td>
         <!-- exibe o status em formato de texto usando funcao-->
          <?php statusTexto($s["status"])?>

          <td>
            <!-- formata a data para o padrao brasileiro -->
             <?= date("d/m/Y H:i", strtotime($s["data_cad"])) ?>
          </td>
          <td>
            <!-- link para ver os detalhes da solicitacao-->
             <a href="cliente_detalhes.php?id=" <? $s["id"] ?>></a>
          </td>
          <td>
            <a href="cliente_detalhes.php?id=" class="btn btn-primary btn-sm">Detalhes</a>
          </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php
include "includes/footer.php";
?>