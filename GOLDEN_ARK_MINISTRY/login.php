<?php  
// Including error reporting   
error_reporting(E_ALL);  
ini_set('display_errors', 1);  

// // Start the session to manage user sessions  
// session_start();  

// Include the database connection   
require_once "connection.php";  

// Check if the form was submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Get the username and password from the form, ensuring proper sanitization  
    $username = trim($_POST['username']);  
    $password = $_POST['password'];  

    // First, prepare the statement to check in the admins table  
    $stmt = $conn->prepare("SELECT admin_id, user_password FROM admins WHERE username = ?;");  

    if (!$stmt) {  
        die("Preparation failed: " . $conn->error);  
    }  

    $stmt->bind_param("s", $username);  
    
    // Execute the statement  
    $stmt->execute();  
    
    // Store the result  
    $stmt->store_result();  

    // Check if a user with the username exists in the admins table  
    if ($stmt->num_rows > 0) {  
        // Bind the result to variables  
        $stmt->bind_result($id, $hashedPassword);  
        $stmt->fetch();  
        
        // Verify the password  
        if (password_verify($password, $hashedPassword)) {  
            // Password is correct, set session variables  
            $_SESSION['username'] = $username;  
            // Redirect to a protected page  
            header("Location: home.php");  
            exit();  
        } else {  
            echo "Invalid password.";  
        }  
    } else {  
        // Now check the members table if not found in admins  
        $stmt->close(); // Close the previous statement  
        
        $stmt = $conn->prepare("SELECT member_id, user_password FROM members WHERE username = ?;");  
        
        if (!$stmt) {  
            die("Preparation failed: " . $conn->error);  
        }  

        $stmt->bind_param("s", $username);  
        $stmt->execute();  
        $stmt->store_result();  

        // Check if a user with the username exists in the members table  
        if ($stmt->num_rows > 0) {  
            // Bind the result to variables  
            $stmt->bind_result($id, $hashedPassword);  
            $stmt->fetch();  

            // Verify the password  
            if (password_verify($password, $hashedPassword)) {  
                // Password is correct, set session variables   
                $_SESSION['username'] = $username;  
                // Redirect to a protected page  
                header("Location: membershome.php");  
                exit();  
            } else {  
                echo "Invalid password.";  
            }  
        } else {  
            echo "Does not exist in the database."; // User not found in either table  
        }  
    }  

    // Close the statement  
    $stmt->close();  
} else {  
    echo "Invalid request method."; // Optional: add a fallback for invalid methods  
}  

// Close the connection  
$conn->close();  
?>