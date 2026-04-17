<?php 
// $senha = password_hash("123456",PASSWORD_DEFAULT);
// echo $senha;


// require_once "class/Usuario.php";
// $usuario = new Usuario();
// $usuario->setNome('milharino Santos');
// $usuario->setEmail('mil@harino.sa');
// $usuario->setSenha('mI2026@TV');
// $usuario->setTipo(2);

// if($usuario->inserir()){
//     echo "Usuario ".$usuario->getNome()." inserido com sucesso com o id".$usuario->getId();
// }

require_once "class/Usuario.php";

$usuario = new Usuario();
if($usuario->buscarPorId(3)){
echo "<pre>";
echo $usuario->getId()."-".$usuario->getNome()."<br>";
}else{
    echo "Usuario nao cadastrado";
    die();
}

$usuario->setNome("Marciano Santos");
echo "<hr>";
echo "<pre>";
if($usuario->atualizar())
    print_r($usuario);


?>
