
<?php
include ("callOpenAi.php");

$file = "test.js";
$code = 'const name = prompt("Enter name")
if (name = "") console.log("No name given" ;';

$Human_review = [
    [
        "file" => $file,
        "issue" => "missing semicolon ",
        "severity" => "high",
        "suggestion" => "Use '===' instead of '=' and close parentheses properly."
    ],
    [
        "file" => $file,
        "issue" => "missing parentheses",
        "severity" => "low",
        "suggestion" => "Use whitespace around the assignment operator for better readability."
    ]
 
];
