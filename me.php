<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Category: Mechanical Engineering</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .topnav {
        background-color: #333;
        overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
        background-color: #ddd;
        color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
        background-color: #04AA6D;
        color: white;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            color:black;
        }
        th {
            background-color:#B3E0FF; 
        }
        tr:nth-child(even) {
            background-color: #FFFFFF; 
        }
        tr:nth-child(odd) {
            background-color:  #E6F7FF;
        }
        </style>
        <script>
            function logout()
            {
                // window.location.replace("LoginPage.html");
                window.location.href="LoginPage.html";
            }
        </script>
</head>
<body>
    <div style='height:100%'>
    <div class="sideMenu" id="side-menu">
        <a class="closebtn" href="javascript:void(0)" onclick="closeNav()">×</a>
        <div class="main-menu">
            <a href="BookSearch.php"><i class="fa-solid fa-search"></i>Book Search</a>  
            <a href="cse.php"><i class="fa-solid fa-book"></i>Category Wise Books</a>
            <a href="AboutGCET.html"><i class="fa-solid fa-circle-info"></i>About GCET Library</a>
            <a href="AboutProject.html"><i class="fa-solid fa-users"></i>About this Project</a>
            <a href="ContactGCET.html"><i class="fa-solid fa-user"></i>Contact Library Department</a>
        </div>
    </div>
    <div id="content-area">
        <span onclick="openNav()" style="font-size:30px;cursor:pointer">☰ </span>
        <button class="logout-btn btn btn-primary" onclick="logout()"><i class="fa-solid fa-power-off"></i>&nbsp;&nbsp;Logout</button>
    </div>
    <div class="topnav">
  <a href="BookSearch.php">GCET Library</a>
  <a href="cse.php">CSE</a>
  <a href="ece.php">ECE</a>
  <a href="eee.php">EEE</a>
  <a href="ce.php">CE</a>
  <a class="active" href="me.php">ME</a>
  <a href="mba.php">MBA</a>
</div>
    <br>
    <div>
	<h1 align="center" style="font-family:Itim">Category: Mechanical Engineering</h1>
    <div>
        <table>
        <tr>
            <th>BOOK ID</th>
            <th>BOOK NAME</th>
            <th>AUTHOR</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
        $tableName = "me";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM $tableName";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["bookid"] . "</td>";
                echo "<td>" . $row["bookname"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        // Close connection
        $conn->close();
        ?>
    </table>
    </div>
    <script>
        function openNav() {
            document.getElementById("side-menu").style.width = "300px";
            document.getElementById("content-area").style.marginLeft = "300px";
        }

        function closeNav() {
            document.getElementById("side-menu").style.width = "0";
            document.getElementById("content-area").style.marginLeft = "0";
        }
    </script>
</div>
</body>
<footer class="bg-light d-flex flex-wrap p-1 justify-content-between footer">
        <div>
            <p>Follow:</p>
            <ul class="items">
                <li><a href="https://twitter.com/GCTCPORTAL">
                        <h3><i class="fa-brands fa-twitter"></i></h3>
                    </a></li>
                <li><a href="https://www.facebook.com/groups/gctcportal">
                        <h3><i class="fa-brands fa-facebook"></i></h3>
                    </a></li>
                <li><a href="https://www.instagram.com/gctcportal">
                        <h3><i class="fa-brands fa-instagram"></i></h3>
                    </a></li>
            </ul>
        </div>
</footer>
</html>