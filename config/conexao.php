<?php
$host ="10.91.47.46";
$db = "servicehubdb01";
$user = "root";
$pass = "123456";

try{
     $pdo = new PDO("mysql:host=$host;dbname =$db;charset=utf8",$user,$pass);
     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //  echo "conectado com sucesso <br>";
    //  var_dump($pdo);


}catch(PDOException $e){
    // var_dump($e ->getMessage());
    die("Erro na conexão: ".$e->getMessage());
}

