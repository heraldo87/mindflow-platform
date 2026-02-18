<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o ID do usuário está na sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>