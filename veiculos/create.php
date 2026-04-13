<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css?v=4">
    <script src="../assets/script.js?v=1"></script>
    <title>Cadastrar Veículo</title>
</head>
<body>
    <h2>Cadastrar Veículo</h2>

    <form action="store.php" method="POST">

        <label>Placa:</label>
        <input type="text" name="placa" required>

        <label>Modelo:</label>
        <input type="text" name="modelo" required>

        <button class="btn btn-success">Cadastrar</button>

    </form>

    <?php if(!isset($_GET['vaga'])):?>
        <a href="index.php" class="btn-link">Voltar</a>
    <?php else: ?>
        <a href="../index.php" class="btn-link">Voltar</a>
    <?php endif ?>


    </div>

</body>
</html>