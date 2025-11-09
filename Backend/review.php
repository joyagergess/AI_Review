
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("callOpenAi.php");


$input = file_get_contents("php://input");

$data1 = json_decode($input, true);

$file = $data1["file"] ?? null;
$code = $data1["code"] ?? null;

if (!$file || !$code) {
    echo json_encode(["error" => "file or code not provided"]);
    exit;
}
$x=callapi($file,$code);
echo json_encode($x, JSON_PRETTY_PRINT);





