<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("callOpenAi.php");

$file = "test.js";
$code = 'const name = prompt("Enter name")
if (name = "") console.log("No name given" ;';

$Human_review = [
    [
        "file" => $file,
        "issue" => "missing semicolon",
        "severity" => "high",
        "suggestion" => " use '===' instead of '=' for comparison."
    ],
    [
        "file" => $file,
        "issue" => "missing closing parenthesis",
        "severity" => "low",
        "suggestion" => "Double check your parentheses to avoid syntax errors."
    ]
];


$AI_review = callapi($file, $code);
$normalize = fn($issues) => array_map(fn($i) => strtolower(trim($i['issue'])), $issues);

$humanIssues = $normalize($Human_review);
$aiIssues = $normalize($AI_review);

$common = array_values(array_intersect($humanIssues, $aiIssues));


$summary = [
  "human_count" => count($humanIssues),
  "ai_count" => count($aiIssues),
  "common_count" => count($common),
  "human_errors" => $humanIssues,
  "ai_errors" => $aiIssues,
  "common_errors" => $common,
  
];

echo json_encode($summary, JSON_PRETTY_PRINT);
