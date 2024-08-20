<?php
require 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

// Get PUT data
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Retrieve and sanitize input
$id = filter_var($data['id'], FILTER_VALIDATE_INT);
$title = filter_var($data['title'], FILTER_SANITIZE_STRING);
$label = filter_var($data['label'], FILTER_SANITIZE_STRING);
$description = filter_var($data['description'], FILTER_SANITIZE_STRING);
$event_date = filter_var($data['event_date'], FILTER_SANITIZE_STRING);
$start_time = filter_var($data['start_time'], FILTER_SANITIZE_STRING);
$end_time = filter_var($data['end_time'], FILTER_SANITIZE_STRING);
$all_day = filter_var($data['all_day'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
$url = filter_var($data['url'], FILTER_VALIDATE_URL);
$guests = filter_var($data['guests'], FILTER_SANITIZE_STRING);
$location = filter_var($data['location'], FILTER_SANITIZE_STRING);

if (!$id || !$title || !$event_date) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

try {
    $stmt = $conn->prepare("UPDATE events SET title = :title, label = :label, description = :description, event_date = :event_date, start_time = :start_time, end_time = :end_time, all_day = :all_day, url = :url, guests = :guests, location = :location WHERE id = :id");
    $stmt->execute([
        ':title' => $title,
        ':label' => $label,
        ':description' => $description,
        ':event_date' => $event_date,
        ':start_time' => $start_time,
        ':end_time' => $end_time,
        ':all_day' => $all_day,
        ':url' => $url,
        ':guests' => $guests,
        ':location' => $location,
        ':id' => $id,
    ]);
    echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to update event', 'error' => $e->getMessage()]);
}
?>