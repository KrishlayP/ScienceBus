<?php
require_once __DIR__ . '/../includes/admin_functions.php';
require_admin();

header('Content-Type: application/json');

$module = $_POST['module'] ?? $_GET['module'] ?? '';
$action = $_POST['action'] ?? $_GET['action'] ?? 'list';

try {
    if ($action === 'delete') {
        require_super_admin();
    }

    if ($action === 'list') {
        echo json_encode(['ok' => true, 'data' => get_collection($module), 'superAdmin' => is_super_admin()]);
        exit;
    }

    if ($module === 'news' && $action === 'save') {
        save_news_item();
    } elseif ($module === 'news' && $action === 'delete') {
        delete_news_item($_POST['id'] ?? '');
    } elseif ($module === 'team' && $action === 'save') {
        save_team_item();
    } elseif ($module === 'team' && $action === 'delete') {
        delete_team_item($_POST['section'] ?? '', $_POST['id'] ?? '');
    } elseif ($module === 'gallery' && $action === 'save') {
        save_gallery_item();
    } elseif ($module === 'gallery' && $action === 'delete') {
        delete_gallery_package((int) ($_POST['category_index'] ?? -1), (int) ($_POST['package_index'] ?? -1));
    } elseif ($module === 'messages' && $action === 'delete') {
        delete_message_item($_POST['id'] ?? '');
    } elseif ($module === 'members' && $action === 'save') {
        save_admin_member();
    } else {
        throw new RuntimeException('Invalid request.');
    }

    echo json_encode(['ok' => true]);
} catch (Throwable $error) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => $error->getMessage()]);
}
