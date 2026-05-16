<?php
require_once __DIR__ . '/includes/data.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Invalid request.']);
    exit;
}

$message = [
    'id' => make_id(),
    'name' => trim($_POST['name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'school' => trim($_POST['school'] ?? ''),
    'message' => trim($_POST['message'] ?? ''),
    'created_at' => date('Y-m-d H:i:s'),
];

if ($message['name'] === '' || $message['email'] === '' || $message['message'] === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'Name, email and message are required.']);
    exit;
}

$data = read_json_data('messages', ['messages' => []]);
array_unshift($data['messages'], $message);
write_json_data('messages', $data);

echo json_encode(['ok' => true, 'message' => 'Message sent successfully.']);
