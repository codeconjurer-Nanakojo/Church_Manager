<?php  
require_once 'connection.php';

$stmt = $conn->prepare("SELECT   
    members.member_id,   
    members.full_name,   
    suggestion.message,   
    suggestion.message_date   
FROM   
    suggestion  
INNER JOIN   
    members   
ON   
    suggestion.member_id = members.member_id");  

if (!$stmt->execute()) {  
    die("Execution failed: " . $stmt->error);  
}  

// Get the result set from the executed statement  
$result = $stmt->get_result();   

// Close the statement  
$stmt->close();  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <link rel="stylesheet" href="contribution.css">  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>HOME</title>  
</head>  
<body>  
    <div class="nav">  
        <div class="churchlogo">  
            <img src="images/church_icon.jpeg" alt="church icon">  
            <p id="app">CHURCH MANAGEMENT SYSTEM</p>  
        </div>  
        <ul class="navitem">  
            <li><a id="active">HOME</a></li>  
            <li><a>ABOUT</a></li>  
        </ul>  
        <div class="navigate">  
            <select name="menu" id="menu">  
                <option value="Home">Home</option>  
                <option value="Members">Members</option>  
                <option value="Event">Event</option>  
                <option value="Groups">Groups</option>  
                <option value="Announcement">Announcement</option>  
                <option value="Logout">Logout</option>  
            </select>  
        </div>  
    </div>  
    <div class="sidebar">  
        <ul class="menu">  
            <li >  
                <a href="#">  
                    <img src="icons/dashboard.png" alt="">  
                    <span>TODAY</span>   
                </a>  
            </li>  
            <li>  
                <a href="register.html">  
                    <img src="icons/register.png" alt="#">  
                    <span>REGISTER</span>   
                </a>  
            </li>  
            <li>  
                <a href="members.php">  
                    <img src="icons/member.jpg" alt="#">  
                    <span>MEMBERS</span>   
                </a>  
            </li>  
            <li>  
                <a href="eventlist.php">  
                    <img src="icons/event3.png" alt="#">  
                    <span>EVENTS</span>   
                </a>  
            </li>  
            <li>  
                <a href="grouplist.php">  
                    <img src="icons/group.webp" alt="#">  
                    <span>GROUPS</span>   
                </a>  
            </li>   
            <li class="active">  
                <a href="contribution.html">  
                    <img src="icons/contribution.jpg" alt="">  
                    <span>CONTRIBUTION</span>   
                </a>  
            </li>  
        </ul>  
        <div class="logout">  
            <form action="home.php" method="post">  
                <button name="logout">  
                    <span>LOGOUT</span>  
                </button>  
            </form>  
        </div>  
    </div>  

    <div class="content">  
        <div class="tabs">  
            <a href="contribution.html">  
                <div class="suggestions">  
                    <img src="icons/sugestion.jpg" alt="">  
                    <span>SUGGESTIONS</span>  
                </div>  
            </a>  
            <a href="">  
                <div class="prayer">  
                    <img src="icons/prayer.jpg" alt="">  
                    <span>PRAYER REQUEST </span>  
                </div>  
            </a>  
            <a href="">  
                <div class="testimony">  
                    <img src="icons/testify.jpeg" alt="">  
                    <span>TESTIMONIES </span>  
                </div>  
            </a>  
            <a href="sponsorlist.php">  
                <div class="testimony">  
                    <img src="icons/testify.jpeg" alt="">  
                    <span>SPONSORS </span>  
                </div>  
            </a>  
        </div>  
        <div class="tableview">  
            <section class="attendance-list">  
            <table style="    border-left: 1px solid;
                    width: 100%;
                    height: 600px;
                    ">
                    <thead>  
                        <tr>  
                            <th>ID</th>  
                            <th>MEMBER NAME</th>  
                            <th style="width: 300px;">SUGGESTION</th>  
                            <th>DATE</th>  
                            <th>Action ✏/❌</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <?php  
                        // Check if there are any suggestions in the database  
                        if ($result->num_rows > 0) {  
                            while ($row = $result->fetch_assoc()) {   
                        ?>  
                                <tr>  
                                    <td><?php echo htmlspecialchars($row['member_id']); ?></td>  
                                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>  
                                    <td><?php echo htmlspecialchars($row['message']); ?></td>  
                                    <td><?php echo htmlspecialchars($row['message_date']); ?></td>  
                                    <td>  
                                        <form style="display:inline;" action="edit_member.php?id=<?php echo $row['member_id']; ?>" method="GET">  
                                            <button type="submit">Edit</button>  
                                        </form>  
                                        <form style="display:inline;" action="delete_member.php?id=<?php echo $row['member_id']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">  
                                            <button type="submit">Delete</button>  
                                        </form>  
                                    </td>  
                                </tr>  
                        <?php   
                            }   
                        } else {  
                            echo '<tr><td colspan="5">No suggestions found.</td></tr>';  
                        }  
                        ?>  
                    </tbody>  
                </table>     
                </section>  
        </div>  
    </div>  
</body>  
</html>