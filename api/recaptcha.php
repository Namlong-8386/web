<?php
require_once __DIR__ . '/config.php';

/**
 * Verify Google reCAPTCHA v2 response token.
 * Returns true if verified, false otherwise.
 *
 * NOTE: Replace test keys with your own from https://www.google.com/recaptcha/admin
 */
function verifyRecaptcha($responseToken) {
    // Test secret key (for localhost testing)
    // Replace with your real secret key for production
    $secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

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
    return isset($json['success']) && $json['success'] === true;
}
