<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "alumni_db"; // Use your actual database name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values using POST
$theme = $_POST['theme'] ?? '';
$batchYear = $_POST['batchYear'] ?? '';
$eventDate = $_POST['eventDate'] ?? '';
$eventVenue = $_POST['eventVenue'] ?? '';
$eventLocation = $_POST['eventLocation'] ?? '';

// Make sure all fields are filled
if (!empty($theme) && !empty($batchYear) && !empty($eventDate) && !empty($eventVenue) && !empty($eventLocation)) {
    $stmt = $conn->prepare("INSERT INTO alumni_events (theme, batch_year, eventDate, venue, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $theme, $batchYear, $eventDate, $eventVenue, $eventLocation);

    if ($stmt->execute()) {
        echo "Event successfully inserted!";
    } else {
        echo "Insert failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please fill in all fields.";
}

$conn->close();

// Redirect to admin page (optional; you can comment this out if you want to see success messages)
header("Location: admin.html");
exit();
?>
