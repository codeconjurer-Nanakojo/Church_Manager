<?php  
require_once 'connection.php';
// Check if the form is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Get form data and sanitize it  
    $sponsor_name = trim($_POST['name']);  
    $amount = trim($_POST['amount']);  
    $product = trim($_POST['product']);  
    $sponsor_time = trim($_POST['time']);  
    $event_id = trim($_POST['event']);  

    // First check if the event already exists  
        // Prepare SQL statement to insert the new event  
        $sql = "INSERT INTO sponsors (sponsor, amount, sponsor_time, product, event_id)   
VALUES ('$sponsor_name', '$amount', '$sponsor_time', '$product','$event_id')";

        // Execute the query  
        if ($conn->query($sql) === TRUE) {  
            echo "New sponsor registered successfully!";  
            header( "location:home.php");
        } else {  
            echo "Error: " . $sql . "<br>" . $conn->error;  
        }  
    }
// Close connection  
$conn->close();  
?>