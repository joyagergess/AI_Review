<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include ("callOpenAi.php");

$file = "test.js";
$code = 'const name = prompt("Enter name")
if (name = "") console.log("No name given" ;';

$Human_review = [
    [
        "file" => $file,
        "issue" => "missing semicolon",
        "severity" => "high",
        "suggestion" => "Use '===' instead of '=' and close parentheses properly."
    ],
    [
        "file" => $file,
        "issue" => " missing_parenthesis",
        "severity" => "low",
        "suggestion" => "Use whitespace around the assignment operator for better readability."
    ]
];

$validated = callapi($file, $code); 

$humanIssues = array_column($Human_review, 'issue');
$aiIssues = array_column($validated, 'issue');

$common = array_values(array_intersect($humanIssues, $aiIssues));
$onlyHuman = array_values(array_diff($humanIssues, $aiIssues));
$onlyAI = array_values(array_diff($aiIssues, $humanIssues));

echo "Common errors:\n";
print_r($common);

echo "\nOnly human errors:\n";
print_r($onlyHuman);

echo "\nOnly AI errors:\n";
print_r($onlyAI);
