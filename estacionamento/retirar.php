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
    // Buscar o tempo de estacionamento 
    $sql = "SELECT
            data_entrada,
            TIMESTAMPDIFF(MINUTE,data_entrada, NOW()) AS tempo_minutos
        FROM movimentacao 
        WHERE id = ? AND data_saida IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $mov = $stmt->fetch();

    if(!$mov){
        $_SESSION['erro'] = "Movimentação não encontrada!";
        header("Location: ../index.php");
        exit;
    }

    // Conversão de tempo
    $min = (int)$mov['tempo_minutos'];
    $horas = floor($min/60);
    $resto = $min%60;

    // Precificação 
    $preco_da_hora = 10; 
    $valor_hora = $horas * $preco_da_hora;
    $valor_minuto = $min * ($preco_da_hora/60);
    $valor_total = $valor_hora + $valor_minuto;

    // Atualizar a tabela 
    $sql = "UPDATE movimentacao
            SET 
                data_saida = NOW(),
                valor_pago = ?
            WHERE id = ? AND data_saida IS NULL";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$valor_total,$id]);

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