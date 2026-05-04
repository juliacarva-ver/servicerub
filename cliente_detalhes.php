<?php

session_start();


require_once "config/conexao.php"; // conexao com o banco

require_once "includes/funcoes.php";

include "includes/header.php";
include "includes/menu.php";
 // Verifica se o usuário está logado e se é do tipo cliente = 2
  if(!isset($_SESSION['usuario_id']) || $_SESSION["tipo"]!=2){
    header("location: login.php");
  }


   if (!isset($_GET['id']) ||($_GET['id'])) { // id pela url  
    die("ID invalido.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM solicitacoes WHERE id = :id AND usuario_id = :usuario_id";
$stmt = obterPdo()->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->bindValue(':usuario_id', $_SESSION['usuario_id']);
$stmt->execute();

$solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitaçao</title>
</head>

<body>
    <h2> detalhe da Solicitacao</h2>
    <p><strong>ID:</strong> <?= $solicitacao['id'] ?></p>
    <p><strong>Data:</strong> <?= $solicitacao['data'] ?></p>
    <p><strong>Status:</strong> <?= $solicitacao['status'] ?></p>

 

<h3>Descrição:</h3>
<p><?= $solicitacao['descricao'] ?></p>

<h3>Resposta do Administrador:</h3>
<p><?= $solicitacao['resposta'] ? $solicitacao['resposta'] : "aguardando resposta" ?></p>

<br>
<a href="cliente_painel.php"> Voltar</a>

</body>
</html>
<?php include 'footer.php'; ?>
</body>

</html>