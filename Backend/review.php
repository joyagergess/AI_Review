
<?php
use Orhanerday\OpenAi\OpenAi;
header('Content-Type: application/json');


$input = File_get_contents("php://input");
$data = json_decode($input,true);

$file= $data["file"];
$code=$data["code"];

$prompt = "You are a code reviewer. '{$file}'.
Return a JSON array of review items Each item must have:
 file, issue, severity: low, medium, or high, suggestion
Code:{$code}
Only return JSON array";


$data = [
    'model' => 'gpt-4o-mini',
    'messages' => [
        ['role' => 'user', 'content' => $prompt]
    ]
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: ' . 'Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
