<?php

if (isset($_SESSION['erro'])) {
    echo "<div class='mensagem erro'>{$_SESSION['erro']}</div>";
    unset($_SESSION['erro']);
}

if (isset($_SESSION['sucesso'])) {
    echo "<div class='mensagem sucesso'>{$_SESSION['sucesso']}</div>";
    unset($_SESSION['sucesso']);
}


?>