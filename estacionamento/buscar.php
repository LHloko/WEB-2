<!--
Requisito a placa 
faço uma busca pela placa no banco de dados 
    se sim
        placa encontrada, ocupo a vaga e volto para o index
    senao
        aviso que a placa nao esta no sistema e vou para o cadastro de veiculo
-->
<?php 
require '../config/conexao.php';
$vaga = $_GET['vaga'];

// Autorequest
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $placa = $_POST['placa'];

    $sql = "SELECT * FROM veiculo WHERE placa = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$placa]);

    $veiculo = $stmt->fetch();

    if($veiculo){
        // O veiculo esta cadastrado
        header("Location: registrar.php?vaga=$vaga&veiculo=".$veiculo['id']);
    } else {
        // Veiculo nao cadastrado, ir para cadastro 
        header("Location: ../veiculos/create.php?vaga=$vaga&placa=$placa");
        exit;
    }
}
?>

<h2>Digite a placa do veiculo</h2>
<form method="POST">
    <input type="text" name="placa" required><br><br>
    <button type="submit">Buscar</button>

</form>