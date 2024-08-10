<?php
// session_start();

require_once "connection.php";

// // Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.html");
//     exit();
// }

// Get the event ID from the URL
$eventId = $_GET['id'];

// Delete the event
$stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
$stmt->bind_param("i", $eventId);

if ($stmt->execute()) {
    echo "success";
    // Redirect to event list page or display a success message
    header("Location: eventlist.php");
    exit();
} else {
    // Handle error: Deletion failed
    die("Error deleting event");
}

$stmt->close();
$conn->close();