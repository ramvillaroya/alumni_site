<?php
header('Content-Type: application/json');
include('alumni_db');

// Get data from the POST request
$data = json_decode(file_get_contents("php://input"));

$theme = $data->theme;
$year = $data->year;
$date = $data->date;
$venue = $data->venue;
$location = $data->location;

// Insert into the database
$sql = "INSERT INTO events (theme, year, date, venue, location) VALUES ('$theme', '$year', '$date', '$venue', '$location')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event added successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
