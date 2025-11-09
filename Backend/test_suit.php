<?php
include 'callOpenAi.php'; 

$File = "sample.py";
$code = 'const name = ';

$Review = callapi($File, $code);

if (!is_array($Review)) {
    echo "The response is not an array";
    exit;
}

$requiredFields = ['file', 'issue', 'severity', 'suggestion'];
$Fields_Present = true;

foreach ($Review as $item) {
    foreach ($requiredFields as $field) {
        if (!array_key_exists($field, $item)) {
            $Fields_Present = false;
            echo "Missing '$field' \n";
        }
    }
}

if ($Fields_Present) {
    echo "Reviews contain all required fields";
}

