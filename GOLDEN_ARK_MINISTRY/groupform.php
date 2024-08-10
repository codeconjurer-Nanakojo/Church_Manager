<?php

require_once 'connection.php';

// Check if the form is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Get the form data  
    $group_name = $conn->real_escape_string($_POST['name']);  
    $group_description = $conn->real_escape_string($_POST['description']);  

    // Prepare the SQL statement  
    $stmt = $conn->prepare("INSERT INTO _groups (group_name, group_description) VALUES (?, ?)");  
    $stmt->bind_param("ss", $group_name, $group_description); // "ss" means two string parameters  

    // Execute the statement and check for success  
    if ($stmt->execute()) {  
        echo "New group created successfully.";  
    } else {  
        echo "Error: " . $stmt->error;  
    }  

    // Close the prepared statement  
    $stmt->close();  
}  

// Close the database connection  
$conn->close();  
?>