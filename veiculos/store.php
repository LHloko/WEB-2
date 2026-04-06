<?php
require '../config/conexao.php';

$placa  = trim($_POST['placa']);
$modelo = trim($_POST['modelo']);
$vaga   = $_POST['vaga'] ?? null;

// Verificar se a placa ja esta cadastrada 
$sql = "SELECT * FROM veiculo WHERE placa = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$placa]);
$veiculo = $stmt->fetch();

// Se ja existir no banco, retorna e aparece o erro 
if($veiculo){
    session_start();
    $_SESSION['erro'] = 'Veiculo já cadastrado!';
    header("Location: ../index.php");
    exit;
}


$sql = "INSERT INTO veiculo (placa, modelo) VALUES (?,?)";
$stmt = $pdo->prepare($sql);

$stmt->execute([$placa, $modelo]);

$id = $pdo->lastInsertId();
// Verifica se veio uma vaga 
if($vaga){
    header("Location: ../estacionamento/registrar.php?vaga=$vaga&veiculo=$id");
} else{
    header("Location: ../index.php");
}

exit; 

?>