<?php
// php/db_connect.php
// Simple DB connection for local evaluation. Edit credentials for your environment.

$host = '127.0.0.1';
$port = 3306;
$user = 'root';     // change if needed
$pass = '';         // change if needed
$db   = 'portfolio';

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    // Simple JSON error (useful for AJAX callers)
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'DB connect failed: ' . $conn->connect_error]);
    exit;
}

$conn->set_charset('utf8mb4');
