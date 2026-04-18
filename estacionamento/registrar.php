<?php 
session_start();
require '../config/conexao.php';

$vaga   = (int)$_GET['vaga'];
$id     = (int)$_GET['veiculo'];

// Validar entrada // 
if (!isset($vaga, $id)){
    $_SESSION['erro'] = 'Dados inválidos';
    header("Location ../index.php");
    exit;
}

try{
    
    // Verificar se a vaga esta ocupada //
    $sql = "SELECT id FROM movimentacao WHERE id_vaga = ? AND data_saida IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$vaga]);

    if($stmt->fetch()){ // Se tiver retorno a vaga ta ocupado retorna erro 
        $_SESSION['erro'] = "Vaga já está ocupada!";
        header("Location ../index.php");
        exit;
    }

    // Registrar a movimentação 
    $sql   =  "INSERT INTO movimentacao (id_veiculo, id_vaga) VALUES (?,?)";
    $stmt  = $pdo->prepare($sql);
    $stmt->execute([$id,$vaga]);
    echo"aqui 1";
    $_SESSION['sucesso'] = "Veiculo estacionado com sucesso!";
    echo"aqui 2";
}catch (PDOException $e) {
    $_SESSION['erro'] = "ERRO: Veiculo não estacionado";
}

header("Location: ../index.php");
exit;
?>