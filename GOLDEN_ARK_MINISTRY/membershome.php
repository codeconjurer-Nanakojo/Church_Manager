<!-- <?php  
// Start the session  
// session_start();  

// // Check if the user is logged in, if not redirect to login page  
// if (!isset($_SESSION['username'])) {  
//     header("Location: loginpage.html");  
//     exit();  
// }  
?>   -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="indexstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <div class="sidebar">
        <a href="profile.html" class="admin">
            <img src="icons/member.jpg" alt="">
            <span>MEMBER</span>
        </a>

        <ul class="menu">
            <li class="active">
                <a href="memberhome.html">
                    <img src="icons/dashboard1.png" alt="">
                    <span>TODAY</span> 
                </a>
            </li>
            <li>
                <a href="baptism.html">
                    <img src="icons/register.png" alt="#">
                    <span>BAPTISM</span> 
                </a>

            <li>
                <a href="donation.html">
                    <img src="icons/donate.jpeg" alt="#">
                    <span>DONATE</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="icons/testify.jpeg" alt="#">
                    <span>TESTIFY</span> 
                </a>
            </li>
        </ul>
        <div class="logout">
            <a href="#">
                <img src="icons/logout1.png" alt="S">
                <span>LOGOUT</span>
            </a>

        </div>

        
    </div>
    <div class="maincontent">
        <div class="header"> 
            <div class="home">
                    <img src="icons/home.jpg" alt="">
                    <span>HOME</span>
                </div>
                <div class="right">
                    <a href="#">ABOUT</a>
                    <a href="#">SUPPORT</a>
                </div>


            </div>
        </div>
    </div>

    <?php  
    // Logout handling  
    // if (isset($_POST['logout'])) {  
    //     // Destroy the session and redirect  
    //     session_destroy();  
    //     header("Refresh:2 loginpage.html");  
    //     exit();  
    // }  
    ?>  
</body>
</html>
