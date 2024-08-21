<?php
require 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

// Get and decode the raw PUT data
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!is_array($data)) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit();
}

// Validate and sanitize inputs
$id = filter_var($data['id'], FILTER_VALIDATE_INT);
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

// Check required fields
if (!$id || !$title || !$event_date) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

try {
    $stmt = $conn->prepare("
        UPDATE events 
        SET 
            title = :title, 
            label = :label, 
            description = :description, 
            event_date = :event_date, 
            start_time = :start_time, 
            end_time = :end_time, 
            all_day = :all_day, 
            url = :url, 
            guests = :guests, 
            location = :location 
        WHERE id = :id
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
        ':location' => $location,
        ':id' => $id
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
} catch (PDOException $e) {
    error_log($e->getMessage()); 
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
}
?>
