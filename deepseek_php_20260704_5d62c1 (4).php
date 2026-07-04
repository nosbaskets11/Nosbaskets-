<?php
// api.php
header('Content-Type: application/json');

$dataFile = 'data.json';

// Lire les données existantes
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $data = json_decode($json, true);
} else {
    $data = [
        'products' => [],
        'categories' => [],
        'brands' => [],
        'blogs' => [],
        'orders' => [],
        'instagram' => [],
        'testimonials' => [],
        'settings' => [
            'whatsapp' => '2290166316356',
            'flashMsg' => 'Livraison gratuite de vos sneakers préférées partout au Bénin !',
            'logo' => null,
            'apiKey' => '',
            'apiSecret' => ''
        ],
        'banners' => []
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $newData = json_decode($input, true);
    if ($newData !== null) {
        file_put_contents($dataFile, json_encode($newData, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    }
    exit;
}

echo json_encode($data);