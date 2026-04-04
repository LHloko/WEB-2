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
    <title>Veiculos Estacionamento</title>
</head>
<body>
    
<h2>Lista de Veículos</h2>

<a href="create.php">Cadastrar Novo Veículo</a>

<table border='2'>
    <tr>
        <th>ID</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Ações</th>
    </tr>

    <?php foreach($veiculos as $v): ?>

    <tr>
        <td><?= $v['id'] ?></td>
        <td><?= $v['placa'] ?></td>
        <td><?= $v['modelo'] ?></td>
        <td>
            <a href="edit.php?id=<?= $v['id'] ?>">EDITAR</a>
            <a href="delete.php?id=<?= $v['id'] ?>">DELETAR</a>
        </td>
    </tr>
    
    <?php endforeach; ?>

</table>

</body>
</html>