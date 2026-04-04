<?php
require '../config/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM veiculo WHERE id = ?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

header("Location: index.php");
exit;


?>