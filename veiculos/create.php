<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veículo</title>
</head>
<body>
    <form action="store.php" method="POST">
        <label>Placa:</label><br>
        <input type="text" name="placa" required><br><br>

        <label>Modelo:</label><br>
        <input type="text" name="modelo" required><br><br>

        <button type="submit">Cadastrar Veiculo</button>
    </form>    

    <a href="index.php">Voltar</a>

</body>
</html>