<?php
session_start();
require 'config/conexao.php';
require 'includes/mensagens.php';

// Testando para uma vaga 
$sql = "SELECT 
            vg.id AS vaga_id,
            vg.num_vaga,
            m.id AS mov_id,
            v.placa,
            v.modelo,
            TIMESTAMPDIFF(MINUTE, m.data_entrada, NOW()) AS tempo_minutos
        FROM vaga vg
        LEFT JOIN movimentacao m 
            ON m.id_vaga = vg.id AND m.data_saida IS NULL
        LEFT JOIN veiculo v 
            ON v.id = m.id_veiculo
        ORDER BY vg.num_vaga";

$stmt = $pdo->query($sql);
$vagas = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css?v=4">
    <script src="assets/script.js?v=1"></script>
    <title>Estacionamento</title>
    
</head>
<body>

<h1>Estacionamento</h1>

<!--Vagas  -->
<div class="vagas-container">
    
    <?php foreach ($vagas as $vaga): ?>

    <!-- VAGAS OCUPADAS -->
    <?php 
        $ocupada = $vaga['mov_id'] !== null;
        
        // Conversão de tempo
        $min = (int)$vaga['tempo_minutos'];
        $horas = floor($min/60);
        $resto = $min%60;
        
        // Precificação 
        $preco_da_hora = 10; 
        $valor_hora = $horas * $preco_da_hora;
        $valor_minuto = $min * ($preco_da_hora/60);
        $valor_total = $valor_hora + $valor_minuto;

    ?>

    <div class="vaga <?= $ocupada ? 'ocupada' : 'livre' ?>">
        <strong>VAGA <?= $vaga['num_vaga'] ?></strong>

        <?php if(!$ocupada): ?>
            <form action="estacionamento/opcoes.php" method="GET">
                <input type="hidden" name="vaga" value="<?= $vaga['vaga_id'] ?>">
                <button class="btn-estacionar">Estacionar</button>
            </form>
        
        <?php else: ?>

            <div>
                <p><?= htmlspecialchars($vaga['placa']) ?></p>
                <p><?= htmlspecialchars($vaga['modelo']) ?></p>
                <p>
                    <strong>Tempo: </strong>
                    <?= $horas ?>h
                    <?= $resto ?>min
                </p>
                <p>
                    <strong>Valor: </strong>
                    R$ <?= number_format($valor_total, 2, ',','.') ?>
                </p>
            </div>

            <form action="estacionamento/retirar.php" method="POST">
                <input type="hidden" name="movimentacao" value="<?= $vaga['mov_id'] ?>">
                <button class="btn-retirar">Retirar</button>
            </form>

        <?php endif; ?>
        
    </div>

    <?php endforeach ?>
</div>

<div style="margin-top: 30px;">
    <a href="historico.php">
        <button class="btn btn-primary">Histórico</button>
    </a>
    <a href="veiculos/index.php">
        <button class="btn btn-primary">Veículos Registrados</button>
    </a>
</div>

</body>
</html>