<?php
require_once __DIR__ . '/config.php';

/**
 * Verify Google reCAPTCHA v3 response token.
 * Returns true if verified (score >= 0.5), false otherwise.
 *
 * NOTE: Configure your keys at https://www.google.com/recaptcha/admin
 */
function verifyRecaptcha($responseToken, $expectedAction = '') {
    $secret = '6LfVOTwtAAAAAAMXgvKXnzCHLMngOsyLjZTy6hO0e';

    if (empty($responseToken)) {
        return false;
    }

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret'   => $secret,
        'response' => $responseToken,
        'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
            'timeout' => 10
        ]
    ];

    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === false) {
        return false;
    }

    $json = json_decode($result, true);
    if (!isset($json['success']) || $json['success'] !== true) {
        return false;
    }

    // For v3: check score (0.0 - 1.0), allow if >= 0.5
    $score = isset($json['score']) ? floatval($json['score']) : 1.0;
    if ($score < 0.5) {
        return false;
    }

    // Optional: verify action matches
    if (!empty($expectedAction) && isset($json['action']) && $json['action'] !== $expectedAction) {
        return false;
    }

    return true;
}
