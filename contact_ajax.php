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
    'name' => trim(isset($_POST['name']) ? $_POST['name'] : ''),
    'email' => trim(isset($_POST['email']) ? $_POST['email'] : ''),
    'school' => trim(isset($_POST['school']) ? $_POST['school'] : ''),
    'message' => trim(isset($_POST['message']) ? $_POST['message'] : ''),
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
