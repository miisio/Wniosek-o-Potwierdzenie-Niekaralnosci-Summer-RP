<?php
header('Content-Type: application/json');

// Jeśli potrzebujesz CORS (np. fetch z innej domeny)
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Brak danych lub niepoprawny JSON']);
    exit;
}

// Przykładowa walidacja pól
if (empty($data['name']) || empty($data['surname'])) {
    echo json_encode(['success' => false, 'error' => 'Wszystkie pola są wymagane']);
    exit;
}

// Tu możesz dodać zapis do bazy lub pliku
// file_put_contents('requests.txt', json_encode($data) . PHP_EOL, FILE_APPEND);

echo json_encode(['success' => true]);
?>
