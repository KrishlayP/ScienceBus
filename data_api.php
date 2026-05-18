<?php
require_once __DIR__ . '/includes/data.php';

header('Content-Type: application/json');

$module = isset($_GET['module']) ? $_GET['module'] : '';

try {
    if ($module === 'news') {
        echo json_encode(load_news_data());
        exit;
    }

    if ($module === 'gallery') {
        echo json_encode(load_gallery_data());
        exit;
    }

    if ($module === 'team') {
        echo json_encode(load_team_data());
        exit;
    }

    http_response_code(404);
    echo json_encode(['ok' => false, 'message' => 'Unknown module.']);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => $error->getMessage()]);
}
