<?php
require 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

// Get the raw POST data and decode it
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit();
}

// Required fields validation
$requiredFields = ['title', 'event_date'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => "Missing required field: $field"]);
        exit();
    }
}

// Assign and sanitize inputs
$title = htmlspecialchars(trim($data['title']), ENT_QUOTES, 'UTF-8');
$label = htmlspecialchars(trim($data['label'] ?? ''), ENT_QUOTES, 'UTF-8');
$description = htmlspecialchars(trim($data['description'] ?? ''), ENT_QUOTES, 'UTF-8');
$event_date = date('Y-m-d', strtotime($data['event_date']));
$start_time = !empty($data['start_time']) ? date('H:i:s', strtotime($data['start_time'])) : null;
$end_time = !empty($data['end_time']) ? date('H:i:s', strtotime($data['end_time'])) : null;
$all_day = !empty($data['all_day']) ? 1 : 0;
$url = !empty($data['url']) && filter_var($data['url'], FILTER_VALIDATE_URL) ? $data['url'] : null;
$guests = htmlspecialchars(trim($data['guests'] ?? ''), ENT_QUOTES, 'UTF-8');
$location = htmlspecialchars(trim($data['location'] ?? ''), ENT_QUOTES, 'UTF-8');

try {
    $stmt = $conn->prepare("
        INSERT INTO events (title, label, description, event_date, start_time, end_time, all_day, url, guests, location)
        VALUES (:title, :label, :description, :event_date, :start_time, :end_time, :all_day, :url, :guests, :location)
    ");
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
    error_log($e->getMessage()); 
    http_response_code(500); // Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to create event']);
}
?>
