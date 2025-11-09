<?php
function guard(array $reviewArray): array {
   
    $validated = [];

    foreach ($reviewArray as $item) {
        if (!isset ($item ["file"], $item["issue"], $item["severity"], $item["suggestion"])){
            continue;
        }
         
        if ($item['severity'] !== 'low' && $item['severity'] !== 'medium' && $item['severity'] !== 'high') {

          continue;
      }
       $validated[] = $item;
    }
    
    return $validated;
}

