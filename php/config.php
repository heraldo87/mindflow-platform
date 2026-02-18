<?php
// Configurações do banco de dados MindFlow
$host = 'localhost';
$db   = 'mindflow_db';
$user = 'mindflow_user';
$pass = '5MajT6zT3hdwLXte'; // Substitua pela senha definida no aaPanel

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>