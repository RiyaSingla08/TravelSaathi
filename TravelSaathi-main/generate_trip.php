<?php
header('Content-Type: application/json');

// Define OpenAI API Key
$openai_api_key = getenv('OPENAI_API_KEY') ?: "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";

// Get JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract fields from JSON data
$destination = $data['destination'] ?? '';
$days = $data['days'] ?? '';
$budget = $data['budget'] ?? '';
$companion = $data['companion'] ?? '';

// Input validation
if (empty($destination) || empty($days) || empty($budget) || empty($companion)) {
    echo json_encode(['error' => 'Please provide all required fields.']);
    exit;
}

// Function to call OpenAI API
function callOpenAI($prompt) {
    global $openai_api_key;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $postData = json_encode([
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ],
        "max_tokens" => 1000,
        "temperature" => 0.7
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $openai_api_key
    ]);

    $result = curl_exec($ch);

    // Capture curl error details
    if (curl_errno($ch)) {
        $error_msg = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return json_encode(['error' => $error_msg]);
    }
    curl_close($ch);

    return $result;
}

// Generate the prompt
$prompt = "Generate a $days-day trip itinerary for $destination with a $budget budget for traveling with $companion. Provide day-by-day activities, hotel recommendations, restaurants, and general weather information.";

// Call the OpenAI function
$response = callOpenAI($prompt);
$responseData = json_decode($response, true);

// Check if the API returned the expected structure
if (isset($responseData['choices'][0]['message']['content'])) {
    $itineraryText = $responseData['choices'][0]['message']['content'];
    echo json_encode([
        'itinerary' => $itineraryText,
        'hotels' => [], 
        'restaurants' => [], 
        'weather' => ''
    ]);
} else {
    // Output raw response and any error details for debugging
    echo json_encode([
        'error' => 'Failed to generate itinerary. Please check the API key or input values.',
        'response_raw' => $response,  // Raw response for debugging
        'response_decoded' => $responseData // Parsed response if possible
    ]);
}
?>
