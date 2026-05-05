<?php 
include_once "config/conexao.php";
session_start();
require_once "class/Servico.php";

if(!isset($_SESSION['usuario_id']) || $_SESSION['tipo']!=1){
header("Location: login.php");
    exit();
} 

include "includes/header.php";
include "includes/menu.php";
 $servicos = Servico:: listar();
?>


<main class="container mt-5">
  <h2>Gerenciar Serviços</h2>
 
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>nome</th>
        <th>Preço</th>
        <th>Descontinuado</th>
        <th>descricao</th>
      </tr>
    </thead>
    <tbody>
        <?php  foreach($servicos as $servico):?>
        <tr>
          <td><?= $servicos['nome'] ?></td>
          <td><?= $servicos['descricao'] ?></td>
          <td><?= $servicos['preco'] ?></td>
          <td>
            <?php 
            $lista = explode(",", $servicos['servicos']);
            foreach($lista as $serv){
                echo '<span class="badge bg-dark me-1 mb-1">'.$serv.'</span>';
            }
            ?>
          </td>
          <td><?= $servicos['status'] ?></td>
          <td><?= date("d/m/Y H:i", strtotime($servicos["data_cad"])) ?></td>
          <td>
            <a href="admin_responder.php?id=" class="btn btn-primary btn-sm">Responder</a>
          </td>
        </tr>
        <?php endforeach?>
    </tbody>
  </table>
 
  <a href="admin_dashboard.php" class="btn btn-secondary">Voltar</a>
</main>
<?php include "includes/footer.php" ?>