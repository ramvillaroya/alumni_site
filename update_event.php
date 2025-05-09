<?php
header('Content-Type: application/json');
include('alumni_db');

// Get data from the POST request
$data = json_decode(file_get_contents("php://input"));

$id = $data->_id;
$theme = $data->theme;
$year = $data->year;
$date = $data->date;
$venue = $data->venue;
$location = $data->location;

// Update event
$sql = "UPDATE events SET theme='$theme', year='$year', date='$date', venue='$venue', location='$location' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event updated successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
