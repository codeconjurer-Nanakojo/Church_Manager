<?php  
require_once 'connection.php';
// Check if the form is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Get form data and sanitize it  
    $event_name = trim($_POST['name']);  
    $event_location = trim($_POST['location']);  
    $event_time = trim($_POST['time']);  
    $event_description = trim($_POST['description']);  

    // First check if the event already exists  
    $check_sql = "SELECT * FROM events WHERE event_name = '$event_name' AND event_location = '$event_location' AND event_time = '$event_time'";  
    $check_result = $conn->query($check_sql);  

    if ($check_result->num_rows > 0) {  
        echo "Event already exists with the same name, location, and time.";  
    } else {  
        // Prepare SQL statement to insert the new event  
        $sql = "INSERT INTO events (event_name, event_location, event_time, event_description) 
        VALUES ('$event_name', '$event_location', '$event_time', '$event_description')";  

        // Execute the query  
        if ($conn->query($sql) === TRUE) {  
            echo "New event registered successfully!";  
            header( "location:home.php");
        } else {  
            echo "Error: " . $sql . "<br>" . $conn->error;  
        }  
    }  
}  

// Close connection  
$conn->close();  
?>