<?php
require_once __DIR__ . '/config.php';

function generateCaptchaId() {
    return bin2hex(random_bytes(8));
}

function saveCaptcha($id, $answer) {
    $file = DATA_DIR . '/captcha.json';
    $data = [];
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $data = json_decode($content, true) ?: [];
    }
    // Cleanup expired entries (> 5 minutes old)
    $now = time();
    foreach ($data as $k => $v) {
        if ($now - $v['time'] > 300) {
            unset($data[$k]);
        }
    }
    $data[$id] = ['answer' => strval($answer), 'time' => $now];
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function getCaptcha($id) {
    $file = DATA_DIR . '/captcha.json';
    if (!file_exists($file)) return null;
    $content = file_get_contents($file);
    $data = json_decode($content, true) ?: [];
    if (!isset($data[$id])) return null;
    if (time() - $data[$id]['time'] > 300) {
        unset($data[$id]);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        return null;
    }
    return $data[$id];
}

function deleteCaptcha($id) {
    $file = DATA_DIR . '/captcha.json';
    if (!file_exists($file)) return;
    $content = file_get_contents($file);
    $data = json_decode($content, true) ?: [];
    if (isset($data[$id])) {
        unset($data[$id]);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }
}
