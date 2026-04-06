<?php 
$vaga = $_GET['vaga'];
?>

<h2>Escolha uma opção</h2><br>
<a href="buscar.php?vaga=<?= $vaga ?>">
    <button>Estacionar veículo já cadastrado</button>
</a>
<br><br>
<a href="../veiculos/create.php?vaga=<?= $vaga ?>">
    <button>Cadastrar novo veículo</button>
</a>