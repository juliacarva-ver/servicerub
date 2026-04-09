<?php
include_once "config/conexao.php";
 
$sql = "select * from usuarios";
$cmd = $pdo->prepare($sql);
$cmd->execute();
 
$servicos = $cmd->fetchAll(PDO::FETCH_ASSOC);
 var_dump($servicos)
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aula PDO PHP</title>
</head>
<body>
    <h2>Lista de Seriços</h2>
    <table border="1" cellpadding = 10>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Descontinuado</th>
        </tr>
 <?php foreach($servicos as $servicos);?>
        <tr>
            <td>1</td>
            <td>Formatacao</td>
            <td>Vamos formatar</td>
            <td>R$150,00</td>
            <td>Não</td>
        </tr>
        <?php  ?>
    </table>
</body>
</html>

