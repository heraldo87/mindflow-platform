<?php

date_default_timezone_set("America/Rio_Branco");

// Garante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método inválido.");
}

// Confere tipo de formulário
$formType = $_POST["form_type"] ?? "";
if ($formType !== "cadastro_colaborador") {
    http_response_code(400);
    exit("Formulário inválido.");
}

// ===== Captura dados =====
$clinica_id       = trim($_POST["clinica_id"] ?? "");
$nome             = trim($_POST["nome"] ?? "");
$email            = trim($_POST["email"] ?? "");
$telefone         = trim($_POST["telefone"] ?? "");
$endereco         = trim($_POST["endereco"] ?? "");
$role             = trim($_POST["role"] ?? "");

$senha            = (string)($_POST["senha"] ?? "");
$confirmar_senha  = (string)($_POST["confirmar_senha"] ?? "");

// ===== Validação básica =====
if ($clinica_id === "" || !ctype_digit($clinica_id)) {
    http_response_code(400);
    exit("Selecione uma clínica válida.");
}

if ($nome === "" || $email === "" || $telefone === "" || $endereco === "" || $role === "") {
    http_response_code(400);
    exit("Preencha todos os campos obrigatórios.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit("E-mail inválido.");
}

// ===== Validação de senha =====
if ($senha === "" || $confirmar_senha === "") {
    http_response_code(400);
    exit("Informe a senha e a confirmação.");
}

if (strlen($senha) < 6) {
    http_response_code(400);
    exit("A senha deve ter no mínimo 6 caracteres.");
}

if ($senha !== $confirmar_senha) {
    http_response_code(400);
    exit("As senhas não coincidem.");
}

// remove máscara do telefone
$telefone = preg_replace('/\D+/', '', $telefone);

$data = date("Y-m-d H:i:s");

// ===== Gera hash seguro da senha (NUNCA envie senha pura) =====
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// ===== Monta JSON =====
$dados = [
    "acao"       => "cadastro_colaborador",
    "clinica_id" => (int)$clinica_id,
    "nome"       => $nome,
    "email"      => $email,
    "senha_hash" => $senha_hash,   // envia hash
    "role"       => $role,
    "telefone"   => $telefone,
    "endereco"   => $endereco,
    "data"       => $data
];

// ===== Envia para n8n =====
$url = "https://n8n.alunosdamedicina.com/webhook-test/mindflow";

$json = json_encode($dados, JSON_UNESCAPED_UNICODE);

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    CURLOPT_POSTFIELDS => $json,
    CURLOPT_TIMEOUT => 20
]);

$resposta = curl_exec($ch);

// ===== Tratamento de erro =====
if (curl_errno($ch)) {
    http_response_code(500);
    echo "Erro ao conectar ao servidor.";
    curl_close($ch);
    exit;
}

$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// ===== Resposta =====
if ($http >= 200 && $http < 300) {
    echo "Colaborador cadastrado com sucesso!";
    header("Location: ../login.php");
    exit;
} else {
    http_response_code(502);
    echo "Erro ao registrar colaborador.";
    header("Location: ../login.php");
    exit;
}
?>
