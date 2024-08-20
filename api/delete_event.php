<?php
require 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}


$input = file_get_contents("php://input");
$data = json_decode($input, true);

$id = filter_var($data['id'], FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    exit();
}

try {
    $stmt = $conn->prepare("DELETE FROM events WHERE id = :id");
    $stmt->execute([':id' => $id]);
    echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
}
?>