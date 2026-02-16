<?php

$url = "https://n8n.alunosdamedicina.com/webhook-test/mindflow";

$dados = json_encode([
    "teste" => "ok"
]);

$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => $dados
    ]
];

$context = stream_context_create($options);

$resposta = @file_get_contents($url, false, $context);

if ($resposta !== false) {
    echo "Recebido com sucesso";
} else {
    echo "Erro ao enviar";
}
