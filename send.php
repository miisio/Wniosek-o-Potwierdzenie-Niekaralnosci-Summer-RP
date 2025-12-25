<?php
header('Content-Type: application/json');

// Pobranie danych POST
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Brak danych']);
    exit;
}

// Twój webhook (Tylko na serwerze, NIE w JS)
$webhook = 'https://discord.com/api/webhooks/1436076640403984417/RgIvY87Cj2Nier35Icwb82UqRFbdi6hvx_ICrhknWsWdxQEp8BYeDtUftwPN_jVzZ1yW';

// Przygotowanie payload
$payload = [
    'username' => 'Summer RP Bot',
    'embeds' => [[
        'title' => '📑 Wniosek o Zaświadczenie o Niekaralności',
        'fields' => [
            ['name'=>'Discord', 'value'=>$data['discord_nick']],
            ['name'=>'Imię', 'value'=>$data['ic_name']],
            ['name'=>'Nazwisko', 'value'=>$data['ic_surname']],
            ['name'=>'PESEL / ID Roblox', 'value'=>$data['pesel']],
            ['name'=>'Cel / powód', 'value'=>$data['reason']],
        ],
        'timestamp' => date(DATE_ATOM)
    ]]
];

// Wyślij do Discorda
$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($payload),
    ]
];

$result = file_get_contents($webhook, false, stream_context_create($options));

if ($result === FALSE) {
    http_response_code(500);
    echo json_encode(['error'=>'Błąd wysyłki']);
} else {
    echo json_encode(['success'=>true]);
}
