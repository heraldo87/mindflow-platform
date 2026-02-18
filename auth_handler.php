<?php
// Inicia a sessão imediatamente
session_start();

// Define que a resposta será SEMPRE JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // --- CORREÇÃO DO CAMINHO ---
    // Definimos o caminho correto do config
    $configFile = __DIR__ . '/php/config.php'; // Se estiver na pasta 'php'
    
    // Se o arquivo config.php estiver na mesma pasta deste arquivo, use:
    // $configFile = __DIR__ . '/config.php';

    if (!file_exists($configFile)) {
        // Tenta procurar na raiz caso não ache na pasta php (fallback)
        if (file_exists(__DIR__ . '/config.php')) {
            $configFile = __DIR__ . '/config.php';
        } else {
            throw new Exception("Arquivo de configuração não encontrado em: $configFile");
        }
    }
    
    require_once $configFile;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['password'] ?? ''; 

        if (!$email || !$senha) {
            echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
            exit;
        }

        // Consulta ao banco
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['logged_in'] = true;
            $_SESSION['last_activity'] = time();

            // Força a gravação da sessão
            session_write_close(); 

            echo json_encode(['success' => true, 'message' => 'Acesso concedido']);
        } else {
            echo json_encode(['success' => false, 'message' => 'E-mail ou senha inválidos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método inválido.']);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Erro interno: ' . $e->getMessage()
    ]);
}
?>