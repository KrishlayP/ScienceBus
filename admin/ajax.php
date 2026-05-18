<?php
require_once __DIR__ . '/../includes/admin_functions.php';
require_admin();

header('Content-Type: application/json');

$module = isset($_POST['module']) ? $_POST['module'] : (isset($_GET['module']) ? $_GET['module'] : '');
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'list');

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
        delete_news_item(isset($_POST['id']) ? $_POST['id'] : '');
    } elseif ($module === 'team' && $action === 'save') {
        save_team_item();
    } elseif ($module === 'team' && $action === 'delete') {
        delete_team_item(isset($_POST['section']) ? $_POST['section'] : '', isset($_POST['id']) ? $_POST['id'] : '');
    } elseif ($module === 'gallery' && $action === 'save') {
        save_gallery_item();
    } elseif ($module === 'gallery' && $action === 'delete') {
        delete_gallery_package((int) (isset($_POST['category_index']) ? $_POST['category_index'] : -1), (int) (isset($_POST['package_index']) ? $_POST['package_index'] : -1));
    } elseif ($module === 'messages' && $action === 'delete') {
        delete_message_item(isset($_POST['id']) ? $_POST['id'] : '');
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
