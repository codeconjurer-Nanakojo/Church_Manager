<?php  
// Including error reporting   
error_reporting(E_ALL);  
ini_set('display_errors', 1);  

// Including the connection  
require_once "connection.php";  

// creating a section for each 

// Storing the input data in variables   
$name = trim($_POST['name']);  
$email = trim($_POST['email']);  
$phone = trim($_POST['phone']);  
$location = trim($_POST['location']);  
$username = trim($_POST['username']);  
$password = trim($_POST['password']);  
$password1 = trim($_POST['password2']);  
$token = trim($_POST['token']);

// Validate if passwords match  
if ($password !== $password1) {  
    echo "Password mismatch";  
    exit; // Stop script execution if passwords do not match  
}  

// Hash the password  
$hashed_password = password_hash($password, PASSWORD_DEFAULT);  

// Prepare statement to check if the username already exists  
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM admins WHERE username = ?");  

if (!$stmt) {  
    die("Preparation failed: " . $conn->error);  
}  

$stmt->bind_param("s", $username); // Bind the username parameter  

if (!$stmt->execute()) {  
    die("Execution failed: " . $stmt->error);  
}  

$result = $stmt->get_result();  
$row = $result->fetch_assoc();  

// Actual validation for existing username  
if ($row['count'] > 0) {  
    // Redirect to the login page if the username already exists  
    header("Location: loginpage.html");  
    exit;  
} elseif(empty($token)) {
    $stmt = $conn->prepare("INSERT INTO members (full_name, email, phone,location, username, user_password) VALUES (?, ?, ?, ?, ?,?)");  
    
    if (!$stmt) {  
        die("Preparation failed for insert: " . $conn->error);  
    }  

    // Bind parameters with correct column names and hashed password  
    $stmt->bind_param("ssssss", $name, $email, $phone, $location,$username, $hashed_password);  

    if (!$stmt->execute()) {  
        die("Execution failed: " . $stmt->error);  
    }  
    $_SESSION['sign_in']=true ;
    $_SESSION['session_id']= $username;
    // Redirecting to the success page  
    header("Location: home.php");  
    exit;  


}else{
    if ($token==999){
        $stmt = $conn->prepare("INSERT INTO admins (full_name, email, phone,location, username, user_password) VALUES (?, ?, ?, ?, ?,?)");  
    
        if (!$stmt) {  
            die("Preparation failed for insert: " . $conn->error);  
        }  
    
        // Bind parameters with correct column names and hashed password  
        $stmt->bind_param("ssssss", $name, $email, $phone, $location,$username, $hashed_password);  
    
        if (!$stmt->execute()) {  
            die("Execution failed: " . $stmt->error);  
        }  
        $_SESSION['sign_in']=true ;
        $_SESSION['session_id']= $username;
        // Redirecting to the success page  
        header("Location: home.php");  
        exit; 

    }else {
        echo "wrong token";

    }

}

// Close the statement and connection  
$stmt->close();  
$conn->close();  
?>