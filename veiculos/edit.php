<?php 

require '../config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM veiculo WHERE id = ?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$veiculo = $stmt->fetch();

?>
<head>
    <link rel="stylesheet" href="../assets/style.css?v=4">
    <script src="../assets/script.js?v=1"></script>
</head>
<body>
    
    <div class="container">
        <h2>Editar Veículo</h2>
        
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">
            
            <label>Placa:</label>
            <input type="text" name="placa" value="<?= $veiculo['placa'] ?>">
            
            <label>Modelo:</label>
            <input type="text" name="modelo" value="<?= $veiculo['modelo'] ?>">
            
            <button class="btn btn-warning">Atualizar</button>
        </form>
        
    </div>
    
</body>

