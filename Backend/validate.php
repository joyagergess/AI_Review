<?php
function validate(array $reviewArray): array {
    $Severities = ['low', 'medium', 'high'];
    $validated = [];

    foreach ($reviewArray as $item) {
        if (!isset $item ["file"], $item["issue"], $item["severity"], $item["suggestion"]){
            continue;
        }
      
    }
}
