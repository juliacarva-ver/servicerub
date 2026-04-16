<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function obterPdo():PDO{
    $host ="10.91.47.46";
    $db = "servicehubdb01";
    $user = "root";
    $pass = "123456";
    static $pdo;
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //  echo "conectado com sucesso <br>";
        //  var_dump($pdo);
    }catch(PDOException $e){
        // var_dump($e ->getMessage());
        die("Erro na conexão: ".$e->getMessage());
    }  
    return $pdo;
}




