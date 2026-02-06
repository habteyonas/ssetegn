<?php
header('Content-Type: application/json');
require 'config.php';

$input = json_decode(file_get_contents("php://input"), true);
$msg = trim($input['message'] ?? '');

if ($msg === '') {
    echo json_encode(['reply' => 'Empty message']);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . GEMINI_API_KEY;

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $msg]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

$reply = $res['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

echo json_encode(['reply' => $reply])?>;
