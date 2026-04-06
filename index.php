<?php
session_start();
require 'config/conexao.php';
require 'includes/mensagens.php';

// Testando para uma vaga 
$sql = "SELECT * FROM movimentacao WHERE id_vaga = 1 AND data_saida IS NULL";
$stmt = $pdo->query($sql);
$ocupada = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estacionamento</title>
</head>
<body>

<h1>Estacionamento</h1>

<!--Vaga 01  -->
<div style="width:200px; height:150px; border:2px solid black; text-align:center; padding:10px;">
    <strong> VAGA 01</strong><br><br>

    <?php if(!$ocupada): ?>
        <form action="estacionamento/opcoes.php">
            <input type="hidden" name="vaga" value="1">
            <button type="submit"> Estacionar </button>
        </form>
    <?php else: ?>
        <p>Ocupada</p> <!-- Implementar outra tela posteriormente --> 
    <?php endif ?>

</div>

</body>
</html>