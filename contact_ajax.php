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

db_exec(
    'INSERT INTO contact_messages (id, name, email, school, message, created_at)
     VALUES (?, ?, ?, ?, ?, ?)',
    [
        $message['id'],
        $message['name'],
        $message['email'],
        $message['school'],
        $message['message'],
        $message['created_at'],
    ]
);

echo json_encode(['ok' => true, 'message' => 'Message sent successfully.']);
