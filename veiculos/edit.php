<?php 

require '../config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM veiculo WHERE id = ?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$veiculo = $stmt->fetch();
var_dump($veiculo);

?>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">

    <label>Placa: </label><br>
    <input type="text" name="placa" value="<?= $veiculo['placa'] ?>"><br><br>

    <label>Modelo: </label><br>
    <input type="text" name="modelo" value="<?= $veiculo['modelo'] ?>"><br><br>

    <button type="submit">Atualizar</button>

</form>

