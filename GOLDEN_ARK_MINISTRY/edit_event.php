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

// Fetch event details
$stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $event = $result->fetch_assoc();
} else {
    // Handle error: Event not found
    die("Event not found");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>