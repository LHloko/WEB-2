<?php
session_start();
if (isset($_SESSION['erro'])) {
    echo "<p style='color:red'>{$_SESSION['erro']}</p>";
    unset($_SESSION['erro']);
}

if (isset($_SESSION['sucesso'])) {
    echo "<p style='color:green'>{$_SESSION['sucesso']}</p>";
    unset($_SESSION['sucesso']);
}


?>