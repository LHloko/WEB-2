<?php

require '../config/conexao.php';

$id     = $_POST['id'];
$placa  = $_POST['placa'];
$modelo = $_POST['modelo'];

var_dump($id);echo"<br>";
var_dump($placa);echo"<br>";
var_dump($modelo);echo"<br>";

$sql = "UPDATE veiculo SET placa = ?, modelo = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$placa, $modelo, $id]);

header("Location: index.php");
exit;


?>