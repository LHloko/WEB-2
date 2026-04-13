<?php
$vaga = $_GET['vaga'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Escolher Ação</title>
    <link rel="stylesheet" href="../assets/style.css?v=4">
</head>
<body>

<div class="central-box">

    <h2>Vaga <?= $vaga ?></h2>

    <a href="buscar.php?vaga=<?= $vaga ?>">
        <button class="btn btn-primary btn-large">
            Veículo já cadastrado
        </button>
    </a>

    <a href="../veiculos/create.php?vaga=<?= $vaga ?>">
        <button class="btn btn-success btn-large">
            Cadastrar novo veículo
        </button>
    </a>

</div>

</body>
</html>