<?php
require_once 'config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['senha'])) {
        // Login bem-sucedido: Criar Sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        
        // Criar Cookie de "Lembrar-me" (opcional, válido por 30 dias)
        setcookie("mindflow_user", $user['nome'], time() + (86400 * 30), "/");

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas.']);
    }
}
?>