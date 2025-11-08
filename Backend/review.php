<?php
header('Content-Type: application/json');


$input = File_get_contents("php://input");
$data = json_decode($input,true);

$file= $data["file"];
$code=$data["code"];

$open_ai = new OpenAi('OPENAI_API_KEY');

$complete = $open_ai->complete([
    'engine' => 'davinci',
    'prompt' => 'Hello',
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);


$data = json_decode($complete, true);
echo $data[][][];