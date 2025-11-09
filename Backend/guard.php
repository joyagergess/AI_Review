<?php
include 'config.php';

function guard(array $reviewArray): array {
    $validated = [];

    foreach ($reviewArray as $item) {
        if (!isset($item["file"], $item["issue"], $item["severity"], $item["suggestion"])) {
            
            if (STRICT_SCHEMA_MODE) continue; 
            else $item = array_merge([
                "file" => "",
                "issue" => "",
                "severity" => "low",
                "suggestion" => ""
            ], $item); 
        }

   
        if (!in_array($item['severity'], ALLOWED_SEVERITIES)) {
            if (STRICT_SCHEMA_MODE) continue; 
            else $item['severity'] = 'low';  
        }

        $validated[] = $item;
    }

    return $validated;
}
