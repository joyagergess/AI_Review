<?php
include 'guard.php';

function callapi($file = [], $code = []) {

    $apiKey = ""; //We should enter the Api key here

    $prompt = Create_Prompt($file, $code);
    $data = Requesting_Data($prompt);
    $response = send_request($data, $apiKey);
    $reviewArray = Parsing_data($response);
    
    return guard($reviewArray);
}


function Create_Prompt($file, $code) {
    return "You are a code reviewer. Review the following code from file '{$file}'.
    Check the language of the code from the file extention.
    Return a JSON array of review items. Each item must have:
    - file: the filename
    - issue: a small identifier of the issue 
    - severity: low, medium, or high
    - suggestion: a small suggestion
    
    Code:
    {$code}

    Only return JSON array, no explanations or extra text.";
}

function Requesting_Data($prompt) {
    return [
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ]
    ];
}

function send_request($data, $apiKey) {
    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . 'Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
        exit;
    }
    
    curl_close($ch);
    return $response;
}

function Parsing_data($response) {
    $responseData = json_decode($response, true);
    $reviewJson = $responseData['choices'][0]['message']['content'] ?? "[]";
    
    preg_match('/\[(.*)\]/s', $reviewJson, $matches);
    $reviewArray = isset($matches[0]) ? json_decode($matches[0], true) : [];

    if (!is_array($reviewArray)) {
        $reviewArray = [];
    }
    return $reviewArray;
}