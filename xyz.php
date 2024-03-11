<?php

// Initialize CURL session
$curl = curl_init();

// Set the API endpoint URL
$url = 'https://api.example.com/data';

// Set CURL options
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30, // Set timeout in seconds
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json', // Set request content type
        'Authorization: Bearer YOUR_ACCESS_TOKEN', // Set authorization header if needed
    ],
]);

// Execute CURL request
$response = curl_exec($curl);

// Check for CURL errors
if ($response === false) {
    $error = curl_error($curl);
    // Handle CURL error
    echo "CURL Error: $error";
} else {
    // Check HTTP status code
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode >= 200 && $httpCode < 300) {
        // Request successful, process response
        $responseData = json_decode($response, true); // Convert JSON response to associative array
        // Handle or display response data
        var_dump($responseData);
    } else {
        // Request failed, handle HTTP error
        echo "HTTP Error: $httpCode";
    }
}

// Close CURL session
curl_close($curl);
