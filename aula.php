<?php
include_once "config/conexao.php";
 
$sql = "select * from servicos";
$cmd = $pdo->prepare($sql);
$cmd->execute();
 
$servicos = $cmd->fetchAll(PDO::FETCH_ASSOC);
// var_dump($servicos)
?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <title>Aula PDO PHP</title>
</head>
 
<body>
    <h2>Lista de Serviços</h2>
    <table border="1" cellpadding=10>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Descontinuado</th>
        </tr>
        <?php foreach ($servicos as $servicos): ?>
            <tr>
                <td><?= $servicos['id'] ?></td>
                <!-- short echo -->
                <td><?= $servicos['nome'] ?></td>
                <td><?= $servicos['descricao'] ?></td>
                <td><?= $servicos['preco'] ?></td>
                <td><?= $servicos['descontinuado'] ? "Sim" : "Não" ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <form action="resform.php" method="post">
        <input type="text" name="txtnome" id="">
        <button type=""></button>
    </form>
</body>
</html>
 
 
<?php
include_once "config/conexao.php";
 
$sql = "select * from clientes";
$cmd = $pdo->prepare($sql);
$cmd->execute();
 
$clientes = $cmd->fetchAll(PDO::FETCH_ASSOC);
// var_dump($servicos)
?>
<table border="1" cellpadding=10>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>CPF</th>
    </tr>
    <?php foreach ($clientes as $clientes): ?>
        <tr>
            <td><?= $clientes['id'] ?></td>
            <!-- short echo -->
            <td><?= $clientes['usuario_id'] ?></td>
            <td><?= $clientes['telefone'] ?></td>
            <td><?= $clientes['cpf'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
 
<?php
include_once "config/conexao.php";
 
$sql = "select * from usuarios";
$cmd = $pdo->prepare($sql);
$cmd->execute();
 
$usuarios = $cmd->fetchAll(PDO::FETCH_ASSOC);
// var_dump($servicos)
?>
<table border="1" cellpadding=10>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Senha</th>
        <th>Tipo</th>
        <th>Ativo</th>
        <th>Primero Login</th>
    </tr>
    <?php foreach ($usuarios as $usuarios): ?>
        <tr>
            <td><?= $usuarios['id'] ?></td>
            <!-- short echo -->
            <td><?= $usuarios['nome'] ?></td>
            <td><?= $usuarios['email'] ?></td>
            <td><?= $usuarios['senha'] ?></td>
            <td><?= $usuarios['tipo'] ?></td>
            <td><?= $usuarios['ativo'] ?></td>
            <td><?= $usuarios['primeiro_login'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>


