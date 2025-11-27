<?php
// php/save_message.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/db_connect.php';

// Get and sanitize inputs
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email address.']);
    exit;
}

// Prepared statement to avoid SQL injection
$stmt = $conn->prepare('INSERT INTO messages (name, email, message) VALUES (?, ?, ?)');
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    exit;
}
$stmt->bind_param('sss', $name, $email, $message);

if ($stmt->execute()) {
    echo json_encode(['status' => 'OK']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Insert failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
