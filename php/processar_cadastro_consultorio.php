<?php
// php/processar_cadastro_consultorio.php

date_default_timezone_set("America/Rio_Branco");

// 1) Garante que veio via POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método não permitido.");
}

// 2) (Opcional) Confere o tipo do formulário
$formType = $_POST["form_type"] ?? "";
if ($formType !== "cadastro_clinica") {
    http_response_code(400);
    exit("Formulário inválido.");
}

// 3) Captura e sanitiza (mínimo necessário)
$nome_fantasia = trim($_POST["nome_fantasia"] ?? "");
$cnpj_cpf      = trim($_POST["documento"] ?? ""); // no form está "documento"
$telefone      = trim($_POST["telefone"] ?? "");
$endereco      = trim($_POST["endereco"] ?? "");  // adicione esse input no form se ainda não tiver

// 4) Valida campos obrigatórios (ajuste conforme sua necessidade)
if ($nome_fantasia === "" || $cnpj_cpf === "" || $telefone === "") {
    http_response_code(400);
    exit("Preencha os campos obrigatórios.");
}

// 5) Normaliza alguns campos (remove máscara, espaços, etc.)
$cnpj_cpf = preg_replace('/\D+/', '', $cnpj_cpf);   // mantém só números
$telefone = preg_replace('/\D+/', '', $telefone);   // mantém só números

$data_criacao = date("Y-m-d");

// 6) Monta payload para o n8n
$url = "https://n8n.alunosdamedicina.com/webhook-test/mindflow";

$dados = [
    "nome_fantasia" => $nome_fantasia,
    "cnpj_cpf"      => $cnpj_cpf,
    "data_criacao"  => $data_criacao,
    "telefone"      => $telefone,
    "endereco"      => $endereco,
    "acao"          => "castro_consultorio"
];

// Converte para JSON
$json = json_encode($dados, JSON_UNESCAPED_UNICODE);

// 7) Envia via cURL
$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS     => $json,
    CURLOPT_TIMEOUT        => 20,
]);

$resposta = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo "Erro ao conectar no webhook: " . curl_error($ch);
    curl_close($ch);
    exit;
}

$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 8) Retorno para o usuário (simples)
if ($http >= 200 && $http < 300) {
    echo "Cadastro enviado com sucesso!<br><br>";
    echo "<pre>";
    print_r(json_decode($resposta, true));
    echo "</pre>";
} else {
    http_response_code(502);
    echo "Webhook respondeu com erro HTTP: " . $http;
    echo "<br>Resposta:<br>";
    echo htmlspecialchars($resposta);
}
