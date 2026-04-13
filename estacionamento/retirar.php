<?php 
session_start();
require "../config/conexao.php";
require "../includes/mensagens.php";

// Validar entrada 
if (!isset($_POST['movimentacao'])){
    $_SESSION['erro'] = 'Dados inválidos!';
    header("Location: ../index.php");
    exit;
}

$id = (int)$_POST['movimentacao'];

try{
    $sql = "UPDATE movimentacao
            SET data_saida = NOW()
            WHERE id = ? AND data_saida IS NULL";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        $_SESSION['erro'] = 'Erro ao retirar veículo.';
    } else {
        $_SESSION['sucesso'] = 'Veículo retirado com sucesso!';
    }

}catch(PDOException $e){
    $_SESSION['erro'] = 'Erro no sistema!';
}

header("Location: ../index.php");
exit;


?>