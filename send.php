<?php
// PROSTA OCHRONA
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit;
}

// ODBIÓR DANYCH
$data = json_decode(file_get_contents("php://input"), true);

// WALIDACJA
if (strlen($data['discord']) < 3) {
    http_response_code(400);
    exit;
}

// WEBHOOK (NIGDY NIE PUBLICZNY)
$webhook = getenv("DISCORD_WEBHOOK");

$payload = [
    "embeds" => [[
        "title" => "📑 Wniosek – Summer RP",
        "fields" => [
            ["name"=>"Discord","value"=>$data['discord']],
            ["name"=>"Imię","value"=>$data['name']],
            ["name"=>"Nazwisko","value"=>$data['surname']],
            ["name"=>"ID Roblox","value"=>$data['pesel']],
            ["name"=>"Cel","value"=>$data['reason']]
        ]
    ]]
];

// WYSYŁKA
$options = [
    "http" => [
        "header" => "Content-Type: application/json",
        "method" => "POST",
        "content" => json_encode($payload)
    ]
];

file_get_contents($webhook, false, stream_context_create($options));
