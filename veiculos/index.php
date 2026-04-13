<?php
require '../config/conexao.php';

try{
    $sql = "SELECT * FROM veiculo ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $veiculos = $stmt->fetchAll();
} catch (PDOException $e){
    die("Erro ao buscar veiculos.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css?v=3">
    <script src="../assets/script.js?v=1"></script>
    <title>Veiculos Estacionamento</title>
</head>
<body>

<div class="container">

    <h2>Lista de Veículos</h2><br>

    <a href="create.php" class="btn btn-primary">Novo Veículo</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($veiculos as $v): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= $v['placa'] ?></td>
            <td><?= $v['modelo'] ?></td>
            <td class="acoes">
                <a href="edit.php?id=<?= $v['id'] ?>" class="btn btn-warning">Editar</a>
                <a href="delete.php?id=<?= $v['id'] ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>

</body>
</html>