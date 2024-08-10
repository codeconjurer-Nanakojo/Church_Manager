<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connection.php";

// Input data
$member_id = trim($_POST['member_id']);
$dob = trim($_POST['date_of_birth']);
$dobd = trim($_POST['date_of_baptism']);
$address = trim($_POST['address']);
$gender = trim($_POST['gender']);
$father = trim($_POST['father']);
$mother = trim($_POST['mother']);
$officiant = trim($_POST['officiant']);

// Basic input validation
if (empty($member_id) || empty($dob) || empty($dobd) || empty($father) || empty($mother) || empty($officiant)) {
    die("All fields are required.");
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO baptism (member_id, date_of_birth, date_of_baptism, address, gender, father, mother, officiant) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssssss", $member_id, $dob, $dobd, $address, $gender, $father, $mother, $officiant);

if (!$stmt->execute()) {
    die("Execution failed: " . $stmt->error);
}

echo "Baptism record added successfully!";

$stmt->close();
$conn->close();
?>