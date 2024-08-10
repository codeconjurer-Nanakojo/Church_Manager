<?php  
// Start the session  
// session_start();  

// setting up a connection  
require_once "connection.php";  

// Check if the user is logged in, if not redirect to login page  
// if (!isset($_SESSION['user_id'])) {  
    // header("Location: login.html");  
    // exit();  
// }  

// querying the database to get all members  
$stmt = $conn->prepare("SELECT group_name, group_description FROM _groups ORDER BY group_name ASC");  
if (!$stmt->execute()) {  
    die("Execution failed: " . $stmt->error);  
}  

$result = $stmt->get_result();  

// closing the connection   
$conn->close();  

?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <link rel="stylesheet" href="members.css">  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>HOME</title>  
    <script>  
        function navigate() {  
            var menu = document.getElementById("menu").value;  
            if(menu === "Logout") {  
                // Confirmation before logout  
                if(confirm('Are you sure you want to logout?')) {  
                    document.getElementById('logoutForm').submit();  
                } else {  
                    document.getElementById("menu").selectedIndex = 0; // Reset selection  
                }  
            } else {  
                window.location.href = menu.toLowerCase() + '.php';  
            }  
        }  
    </script>  
</head>  
<body>  
    <div class="nav">  
        <div class="churchlogo">  
            <img src="images/church_icon.jpeg" alt="church icon">  
            <p id="app">CHURCH </p>  
        </div>  
        <ul class="navitem">  
            <li><a id="active">HOME</a></li>  
            <li><a>ABOUT</a></li>  
        </ul>  
        <div class="navigate">  
            <select name="menu" id="menu" onchange="navigate()">  
                <option value="home">Home</option>  
                <option value="members">Members</option>  
                <option value="event">Event</option>  
                <option value="groups">Groups</option>  
                <option value="announcement">Announcement</option>  
                <option value="logout">Logout</option>  
            </select>  
        </div>  
    </div>  
    <div class="sidebar">  
        <ul class="menu">  
            <li>            
                <a href="home.php">  
                    <img src="icons/dashboard.png" alt="Dashboard">  
                    <span>TODAY</span>   
                </a>  
            </li>  
            <li>  
                <a href="register.html">  
                    <img src="icons/register.png" alt="Register">  
                    <span>REGISTER</span>   
                </a>  
            </li>  
            <li >  
                <a href="members.php">  
                    <img src="icons/member.jpg" alt="Members">  
                    <span>MEMBERS</span>   
                </a>  
            </li>  
            <li >  
                <a href="eventlist.php">  
                    <img src="icons/event3.png" alt="Events">  
                    <span>EVENTS</span>   
                </a>  
            </li>  
            <li class="active">  
                <a href="grouplist.php">  
                    <img src="icons/group.webp" alt="Groups">  
                    <span>GROUPS</span>   
                </a>  
            </li>  
        </ul>  
        <div class="logout">  
            <form id="logoutForm" action="" method="post">  
                <button type="submit" name="logout">  
                    <span>LOGOUT</span>  
                </button>  
            </form>  
        </div>  
    </div>   
    <div class="container">  
        <header>  
            <h1>GROUPS</h1>  
        </header>  
        <main>  
            <section class="attendance-list">  
                <table>  
                    <thead>  
                        <tr>  
                            <th>Name</th>  
                            <th>Description</th>  
                            <th>Action ✏/❌</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <?php  
                        // checking if there are any event in the database  
                        if ($result->num_rows > 0) {  
                            while ($row = $result->fetch_assoc()) {   
                        ?>  
                                <tr>  
                                    <td><?php echo htmlspecialchars($row['group_name']); ?></td>  
                                    <td><?php echo htmlspecialchars($row['group_description']); ?></td>  
                                    <td>  
                                        <form style="display:inline;" action="edit_member.php?id=<?php echo $row['username']; ?>" method="GET">  
                                            <button type="submit">Edit</button>  
                                        </form>  
                                        <form style="display:inline;" action="delete_member.php?id=<?php echo $row['username']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">  
                                            <button type="submit">Delete</button>  
                                        </form>  
                                    </td>  
                                </tr>  
                        <?php   
                            }   
                        } else {  
                            echo '<tr><td colspan="6">No members found.</td></tr>';  
                        }  
                        ?>  
                    </tbody>  
                </table>  
            </section>  
        </main>  
    </div>  

    <?php  
    // // Logout handling  
    // if (isset($_POST['logout'])) {  
    //     // Destroy the session and redirect  
    //     session_destroy();  
    //     header("Location: login.html");  
    //     exit();  
    
    ?>   
</body>  
</html>