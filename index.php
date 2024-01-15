<?php
// Receive form data and token
$token = $_POST['g-recaptcha-response'];
$secretKey = 'LdeqEspAAAAAET3kGGglzh3MUdnp6IeUm0W3e4X'; // Replace with your actual secret key
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => $secretKey, 'response' => $token);

// Verify token with Google
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseData = json_decode($response);

if ($responseData->success) {
    // Process form data (e.g., send email, store in database)
    // ...

    echo "Verification successful!"; // Send success response to client
} else {
    echo "Verification failed!"; // Send failure response to client
}
?>
