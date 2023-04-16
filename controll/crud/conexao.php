<?php
$user = "root";
$password = "";

try{
    $conexao = new PDO('mysql:host=localhost;dbname=sge3', $user, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
}