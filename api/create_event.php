<?php
require 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

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

if (!$title || !$event_date) {
    http_response_code(400); 
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

try {
    $stmt = $conn->prepare("INSERT INTO events (title, label, description, event_date, start_time, end_time, all_day, url, guests, location) VALUES (:title, :label, :description, :event_date, :start_time, :end_time, :all_day, :url, :guests, :location)");
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
        ':location' => $location
    ]);
    http_response_code(201); // Created
    echo json_encode(['status' => 'success', 'message' => 'Event created successfully']);
} catch (PDOException $e) {
    http_response_code(500); // Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to create event', 'error' => $e->getMessage()]);
}
?>