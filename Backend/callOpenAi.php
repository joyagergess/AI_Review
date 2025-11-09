
<?php
 include 'guard.php';
 

 function callapi($file=[],$code=[]){
   
   
   $prompt = "You are a code reviewer. Review the following code from file '{$file}'.
   Check the language of the code from the file extention.
   Return a JSON array of review items. Each item must have:
   - file: the filename
   - issue: a small identifier of the issue 
   - severity: low, medium, or high
   - suggestion: a small suggestion
   
   Code:
   {$code}
   
   Only return JSON array, no explanations or extra text.";
   
   $data = [
       'model' => 'gpt-4o-mini',
       'messages' => [
           ['role' => 'user', 'content' => $prompt]
       ]
   ];
   
   $ch = curl_init('https://api.openai.com/v1/chat/completions');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, [
       'Content-Type: application/json',
       'Authorization: ' . 'Bearer ' . $apiKey
   ]);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
   
   $response = curl_exec($ch);
   
   if (curl_errno($ch)) {
       echo json_encode(['error' => curl_error($ch)]);
       exit;
   }
   
   curl_close($ch);
   
   $responseData = json_decode($response, true);
   $reviewJson = $responseData['choices'][0]['message']['content'] ?? "[]";
   
   preg_match('/\[(.*)\]/s', $reviewJson, $matches);
   if (isset($matches[0])) {
       $reviewArray = json_decode($matches[0], true);
   } else {
       $reviewArray = [];
   }
   
   if (!is_array($reviewArray)) {
       $reviewArray = [];
   };
   
   return $validated = guard($reviewArray);
   
 }