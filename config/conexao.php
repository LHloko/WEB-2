<?php
// Config do banco 
$host   = 'localhost';
$db     = 'estacionamento';
$user   = 'estac_user';
$pass   = 'estac123';
$charset= 'utf8mb4';

// DSN - Data source name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO - Entra no lugar do mysqli 
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // erros com exceçao 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // retorna array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // usa prepared real 
];

// Teste 
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e){
    die('Erro na conexao com o banco de dados.');
}



?>