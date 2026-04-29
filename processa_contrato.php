<?php 
session_start();

require_once "class/Cliente.php";
require_once "class/Usuario.php";
require_once "class/Servico.php";
require_once "class/solicitacao2.php";
require_once "class/ServicoSolicitacao.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST"){
    header("Location: contratar.php?erro=Invalid Request.");
    exit();
}

// verificaçao de segurança (se quem está logado tem direito de carregar essa página)
//csrf

$token = $_POST['csrf_token']?? "";
if(!$token || !isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token'])
    {
    header("location: contratar.php?erro=Falha de segurança CSRF detectada.");
    exit();
}

//input (sao os campos do formulario)
$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_SPECIAL_CHARS);

$endereco = filter_input(INPUT_POST,'endereco',FILTER_UNSAFE_RAW);
$descricao = filter_input(INPUT_POST,'descricao',FILTER_UNSAFE_RAW);

$data_preferida = filter_input(INPUT_POST,'data_preferida', FILTER_SANITIZE_SPECIAL_CHARS);

$cpf =preg_replace('/\D/','',$_POST['cpf'] ??"");
$servicos_ids = $_POST['servicos_id'] ?? []; //array de serviços

//validacao dos servicos
if(!is_array($servicos_ids)){
header("location: contratar.php?erro=selecione pelo menos um servico.");
exit();
}
$servicos_validos =[];
foreach($servicos_ids as $id){
$id =filter_var($id, FILTER_VALIDATE_INT);
$servicos_validos[] = $id;
}

//validacao geral 
if(!$nome || strlen($nome) < 3){
   header("location: contratar.php?erro=Nome Invalido.");
exit(); 
}

if(!$email){
   header("location: contratar.php?erro=Email Invalido.");
exit(); 
}

if(!$telefone || strlen($telefone) < 8){
   header("location: contratar.php?erro=Telefone Invalido.");
exit(); 
}

if(!$endereco || strlen($endereco) < 5){
   header("location: contratar.php?erro=Endereco Invalido.");
exit(); 
}

if(!$descricao || strlen($descricao) < 10){
   header("location: contratar.php?erro=Descreva melhor o problema (minnimo 10caracteres.");
exit(); 
}

if(!$cpf && strlen($cpf) != 11){
   header("location: contratar.php?erro=Cpf invalido. Digite 11 numero");
exit(); 
}

if(count($servicos_validos) < 1){
    header("Location: contratar.php?erro=Selecione ao menos um servico valido");
    exit(); 
}

if($data_preferida){
    $ts = strtotime($data_preferida);
    if($ts === false){
      header("Location: contratar.php?erro=Data invalida");
    exit();   
    }
    if($ts < strtotime(date('Y-m-d'))){
      header("Location: contratar.php?erro=Data nao pode ser anterior a hoje ");
    exit();     
    }
}

//verificar se o usuario existe
$usuarioBanco = new Usuario();
 if ($usuarioBanco->buscarPorEmail($email)==false){
    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha("123456");
    $usuario->setTipo(2);
    $usuario->setAtivo(2);
    $usuario->setPrimeiroLogin(true);
    if   (!$usuario->inserir()){
        header("Location: contratar.php?erroErro ao cadastrar o usuario");
    exit();
    }
    $usuario_id = $usuario->getId();
 }else{
    $usuario_id = $usuarioBanco->getId();
 }

 // verificar se o cliente existe 
 $cliente = new Cliente();
 if ($cliente->buscarPorUsuario($usuario_id)==false){
    // gravamos o cliente 
    $cliente->setUsuario_id($usuario_id);
    $cliente->setTelefone($telefone);
    $cliente->setCpf($cpf);
    if(!$cliente->inserir()){
       header("Location: contratar.php?erroErro ao cadastrar cliente");
    exit(); 
    }
 }
 $cliente_id = $cliente->getId();

