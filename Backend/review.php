
<?php
use Orhanerday\OpenAi\OpenAi;
header('Content-Type: application/json');


$input = File_get_contents("php://input");
$data = json_decode($input,true);

$file= $data["file"];
$code=$data["code"];

$prompt = "You are a code reviewer. Review the following code from file '{$file}'.
Return a JSON :
file, issue, severity (low, medium, or high)
and suggestion
Code:{$code}

Only return JSON array.";

