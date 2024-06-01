<?php
set_time_limit(0);

// Define the API key and the base URL for the Financial Modeling Prep API
$api_key = '6fPRdhwBHTpkm3FjMWPGuOM05S1a2m6x';
$base_url = 'https://financialmodelingprep.com/api/v3/';

// Function to make a GET request to the API
function make_api_request($url) {
    $channel = curl_init();
    curl_setopt($channel, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($channel, CURLOPT_HEADER, 0);
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($channel, CURLOPT_URL, $url);
    curl_setopt($channel, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($channel, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($channel, CURLOPT_TIMEOUT, 0);
    curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);

    $output = curl_exec($channel);
    if (curl_error($channel)) {
        return 'error:' . curl_error($channel);
    }
    curl_close($channel);
    return $output;  // Return the raw output
}

// Search for the company
if (isset($_GET['query'])) {
    $company_symbol = htmlspecialchars($_GET['query']);
    $search_url = $base_url . 'quote/' .  urlencode($company_symbol) . '?apikey=' . $api_key;
    $response = make_api_request($search_url);
    if (strpos($response, 'error:') === 0) {
        // Handle curl error
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => $response]);
    } else {
        // Return the API response
        echo $response;
    }
} else {
    echo json_encode(['error' => 'No query parameter provided']);
}