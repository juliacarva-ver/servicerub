<?php
$host ="10.91.47.46";
$db = "servicehubdb01";
$user = "root";
$pass = "123456";

try{
     $pdo = new PDO("mysql:host=$host;dbname =$db;charset=utf8",$user,$pass);
}catch(PDOException $e){
    die("Erro na conexão: ".$e->getMessage());
}
    

