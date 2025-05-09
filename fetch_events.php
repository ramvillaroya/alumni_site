<?php
header('Content-Type: application/json');
include('alumni_db');

$sql = "SELECT * FROM events"; // Assuming your table is named 'events'
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo json_encode([]);
}

$conn->close();
?>
