<?php
require '../config/conexao.php';

$placa  = $_POST['placa'];
$modelo = $_POST['modelo'];

$sql = "INSERT INTO veiculo (placa, modelo) VALUES (?,?)";
$stmt = $pdo->prepare($sql);

$stmt->execute([$placa, $modelo]);

header("Location: index.php");
exit;

?>