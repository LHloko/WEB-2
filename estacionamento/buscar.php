<?php
require '../config/conexao.php';

$vaga = $_GET['vaga'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $placa = $_POST['placa'];

    $sql = "SELECT * FROM veiculo WHERE placa = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$placa]);

    $veiculo = $stmt->fetch();

    if ($veiculo) {
        header("Location: registrar.php?vaga=$vaga&veiculo=".$veiculo['id']);
        exit;
    } else {
        header("Location: ../veiculos/create.php?vaga=$vaga&placa=$placa");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar Veículo</title>
    <link rel="stylesheet" href="../assets/style.css?v=4">
</head>
<body>

<div class="central-box">

    <h2>Buscar Veículo</h2>

    <form method="POST">

        <input 
            type="text" 
            name="placa" 
            placeholder="Digite a placa"
            class="input-busca"
            required
        >

        <button class="btn btn-primary btn-large">
            Buscar
        </button>

    </form>

</div>

</body>
</html>