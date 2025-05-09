<?php
header('Content-Type: application/json');
include('alumni_db');

// Get event ID from the URL
$id = $_GET['id'];

// Delete event
$sql = "DELETE FROM events WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event deleted successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
