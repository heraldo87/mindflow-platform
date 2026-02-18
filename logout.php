<?php
// Inicia a sessão para ter acesso aos dados atuais
session_start();

// 1. Limpa todas as variáveis da sessão global
$_SESSION = array();

// 2. Apaga o cookie da sessão no navegador
// Isso é crucial para segurança: invalida o ID no browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destrói a sessão no servidor
session_destroy();

// 4. Redireciona para o login com uma flag de sucesso
header("Location: login.php?logout=success");
exit;
?>