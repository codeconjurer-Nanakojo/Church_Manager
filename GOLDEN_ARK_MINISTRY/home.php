
<?php
// include connection
require_once 'connection.php';

// adding error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// query the database for number of members
$query = "SELECT COUNT(*) FROM members";
$result = mysqli_query($conn, $query);
$count = mysqli_fetch_array($result);
// echo $count[0];
?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <link rel="stylesheet" href="home.css">  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>HOME</title>  
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            background-color: #5719e7;
            color: #fff;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .dashboard-item {
            box-shadow: 0 2px 5px #0000001a;
            padding: 20px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }

        .item1 {
            background-color: #8673b4;
        }

        .item2 {
            background-color: #c29137;
        }

        .item3 {
            background-color: #181d49;
        }

        .item4 {
            background-color: #c40e0e;
        }

        .item5 {
            background-color: #f59211e7;
        }

        .item6 {
            background-color: #108fd8;
        }

        .item7 {
            background-color: #ecca0a;
        }

        .item8 {
            background-color: #1fcf3d;
        }

        .item9 {
            background-color: #c40e0e;
        }

        .item10 {
            background-color: #c40eb5;
        }

        .dashboard-item h2 {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .dashboard-item p {
            font-size: 20px;
            font-weight: bold;
        }
        main {
            transition: all 0.7s linear;
        }

        .sidebar:hover + main {
            /* transform: translateX(200px); */
            margin-left: 170px;
        }
    </style>
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
            <li class="active">  
                <a href="home.php">  
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
            <li >  
                <a href="contribution.php">  
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

    <main style="padding-top: 70px;padding-left:60px">
        <div class="dashboard-container">
            <div class="dashboard-item item1">
                <h2>🏛  Total House Churches </h2>
                <p>320</p>
            </div>

            <div class="dashboard-item item2">
                <h2>👨🏿‍🤝‍👨🏾 Total Members</h2>
                <?php
                echo "<h4>$count[0]</h4>";
                ?>
            </div>

            <div class="dashboard-item item3">
                <h2>🌧 Total Baptisms</h2>
                <p>1300</p>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-item item4">
                <h2>📊 Total Tithe Payers This</h2>
                <p>0</p>
            </div>

            <div class="dashboard-item item5">
                <h2>📚Total Walefare Payers This Month</h2>
                <p>0</p>
                <h6>Num Paid: 0 </h6>
                <h6>Num Not Paid: 1520</h6>
            </div>
            <div class="dashboard-item item6">
                <h2>💷vTotal Offerings This Month</h2>
                <p>0</p>
                <h6>Num Paid: 0 </h6>
                <h6>Num Not Paid: 1520</h6>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-item item7">
                <p>GH₵50,000.00</p>
                <h5>Total Donations</h5>
            </div>
            <div class="dashboard-item item8">
                <p>GH₵820,000.00</p>
                <h5>Total Assets</h5>
            </div>
            <div class="dashboard-item item9">
                <p>85</p>
                <h5>Total Zones</h5>
            </div>
            <div class="dashboard-item item10">
                <p>105</p>
                <h5>Subzones</h5>
            </div>
        </div>
    </main>



</body>  
</html>