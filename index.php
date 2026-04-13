<?php
session_start();
require 'config/conexao.php';
require 'includes/mensagens.php';

// Testando para uma vaga 
$sql = "SELECT m.id, v.placa, v.modelo 
        FROM movimentacao m
        JOIN veiculo v on v.id = m.id_veiculo
        WHERE m.id_vaga = 1 AND m.data_saida IS NULL";
$stmt = $pdo->query($sql);
$ocupada = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css?v=3">
    <script src="assets/script.js?v=1"></script>
    <title>Estacionamento</title>
    
</head>
<body>

<h1>Estacionamento</h1>

<!--Vaga 01  -->
<div class="vagas-container">
    
    <div class="vaga <?= $ocupada ? 'ocupada' : 'livre' ?>">

        <strong>VAGA 01</strong>

        <?php if (!$ocupada): ?>

            <form action="estacionamento/opcoes.php" method="GET">
                <input type="hidden" name="vaga" value="1">
                <button class="btn-estacionar">Estacionar</button>
            </form>

        <?php else: ?>

            <div>
                <p><?= htmlspecialchars($ocupada['placa']) ?></p>
                <p><?= htmlspecialchars($ocupada['modelo']) ?></p>
            </div>

            <form action="estacionamento/retirar.php" method="POST">
                <input type="hidden" name="movimentacao" value="<?= $ocupada['id'] ?>">
                <button class="btn-retirar">Retirar</button>
            </form>

        <?php endif; ?>

    </div>

</div>

</body>
</html>