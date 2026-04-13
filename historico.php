<?php 
require "config/conexao.php";

// Buscar o histórico 
$sql = "SELECT 
            v.modelo, 
            v.placa,
            m.data_entrada,
            m.data_saida, 
            m.valor_pago,
            TIMESTAMPDIFF(MINUTE, m.data_entrada, m.data_saida) AS tempo_minutos
        FROM 
            movimentacao m 
        INNER JOIN 
            veiculo v ON m.id_veiculo = v.id
        WHERE  
            m.data_saida IS NOT NULL 
        ORDER BY m.data_saida DESC";

$stmt = $pdo->query($sql);
$historico = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico</title>
    <link rel="stylesheet" href="assets/style.css?v=4">
</head>
<body>

<div class="container">

    <h2>Histórico de Estacionamento</h2>

    <a href="index.php" class="btn-link">← Voltar</a>

    <table>
        <tr>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Tempo</th>
            <th>Valor</th>
        </tr>

        <?php foreach ($historico as $h): ?>

        <?php
            $min = (int) $h['tempo_minutos'];
            $horas = floor($min / 60);
            $resto = $min % 60;
        ?>

        <tr>
            <td><?= htmlspecialchars($h['placa']) ?></td>
            <td><?= htmlspecialchars($h['modelo']) ?></td>
            <td><?= $h['data_entrada'] ?></td>
            <td><?= $h['data_saida'] ?></td>
            <td><?= $horas ?>h <?= $resto ?>min</td>
            <td>R$ <?= number_format($h['valor_pago'], 2, ',', '.') ?></td>
        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>