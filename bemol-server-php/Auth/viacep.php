<?php
  // Check if the API key is provided and valid
  $apiKey = $_GET['api_key'];
  if ($apiKey !== 'your-api-key') {
    http_response_code(401);
    echo json_encode(array('error' => 'Unauthorized'));
    exit();
  }

  // Get the CEP from the query parameters
  $cep = $_GET['cep'];

  // Create the ViaCEP API endpoint URL
  $url = "https://viacep.com.br/ws/{$cep}/json/";

  // Make the request to ViaCEP API
  $response = file_get_contents($url);

  // Forward the response to the client
  header('Content-Type: application/json');
  echo $response;
?>
