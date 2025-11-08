
<?php
use Orhanerday\OpenAi\OpenAi;
header('Content-Type: application/json');


$input = File_get_contents("php://input");
$data = json_decode($input,true);

$file= $data["file"];
$code=$data["code"];

