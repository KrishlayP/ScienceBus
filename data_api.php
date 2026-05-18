<?php
require_once __DIR__ . '/includes/data.php';

header('Content-Type: application/json');

$module = $_GET['module'] ?? '';

function api_fallback_data(string $module): ?array
{
    if ($module === 'news') {
        return read_legacy_json_data('news', ['news' => []]);
    }

    if ($module === 'gallery') {
        return read_legacy_json_data('gallery', ['categories' => []]);
    }

    if ($module === 'team') {
        return read_legacy_json_data('team', default_team_data());
    }

    return null;
}

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
    $fallback = api_fallback_data($module);
    if ($fallback !== null) {
        header('X-ScienceBus-Data-Source: json-fallback');
        echo json_encode($fallback);
        exit;
    }

    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => $error->getMessage()]);
}
