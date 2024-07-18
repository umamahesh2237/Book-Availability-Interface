<?php
$connection = mysqli_connect("localhost", "root", "", "library");

// Function to sanitize user input to prevent SQL injection
function sanitizeInput($input)
{
    global $connection;
    return mysqli_real_escape_string($connection, $input);
}

// Initialize $remainingqty
$remainingQuantity = '';
$latestIssuedate = '';
if (isset($_POST['search'])) {
    $bookname = sanitizeInput($_POST['book']);
    $query = "SELECT qty, date FROM mainbook WHERE bookname = '$bookname'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $remainingQuantity = $row['qty'];
        $latestIssuedate = $row['date'];

        if ($remainingQuantity <= 0) {
            // If the quantity is zero
            echo '<script>alert("Book is not available.");</script>';
        }
    } else {
        // If the book is not found in the database
        $remainingQuantity = 'Book not found';
        $latestIssuedate = 'N/A';
    }
}

// Update the following line to check if the quantity is zero
$acceptDisabled = ($remainingQuantity <= 0) ? 'disabled' : '';

if (isset($_POST['accept'])) {
    $bookname = sanitizeInput($_POST['book']);
    $query = "SELECT qty FROM mainbook WHERE bookname = '$bookname'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $remainingQuantity = $row['qty'];

        if ($remainingQuantity > 0) {
            $query = "UPDATE mainbook SET qty = qty - 1, date = NOW() WHERE bookname = '$bookname'";
            mysqli_query($connection, $query);

            // Redirect to BookSearch.php after updating the quantity
            header("Location: hello.php");
            exit();
        } else {
            // If the quantity is zero
            echo '<script>alert("Book is not available.");</script>';
        }
    } else {
        // If the book is not found in the database
        $remainingQuantity = 'Book not found';
        $latestIssuedate = 'N/A';
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<title>GCET Library</title>
	<link href="style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<form method="post">
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
		<!-- <button id="qwe"> Logout</button> -->
		<button class="logout-btn btn btn-primary" id="qwe"><i class="fa-solid fa-power-off"></i>&nbsp;&nbsp;Logout</button>
	</div>
    <!DOCTYPE html>
<html>

<head>
<style>
        /* Styles for the form and container */
        /* body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        } */
        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
        }

        button.logout-btn {
            background-color: #dc3545;
            margin-left: 10px;
        }
        /* .footset{
            position : relative;
            height : 100%;
            width : 100%;
        } */
        footer {
            width : 100%;
            /* bottom: 0px;
            position : absolute; */
            margin-top : 150px;
        }
        </style>

    <title>Book Search</title>
	<script>
	function openNav() {
		document.getElementById("side-menu").style.width = "300px";
		document.getElementById("content-area").style.marginLeft = "300px"; 
	}

	function closeNav() {
		document.getElementById("side-menu").style.width = "0";
		document.getElementById("content-area").style.marginLeft= "0";  
	}

	const button = document.getElementById("qwe");
	button.addEventListener('click', function() {
		window.location.href = "LoginPage.html";
	});
</script>
</head>
<body>
    <div class="container footset">
        <h1>GCET Library</h1>
        <form method="POST" action="">
            <label for="book">Enter Book Name:</label>
            <input type="text" name="book" id="book" required>
            <button type="submit" name="search">Search</button>
            <br><br><br>
            <label for="quantity">Remaining Quantity:</label>
            <input type="text" name="quantity" id="quantity" value="<?php echo isset($remainingQuantity) ? $remainingQuantity : ''; ?>" readonly>
            <br><br><br>
            <label for="latest_issue_date">Latest Issue date:</label>
            <input type="text" name="latest_issue_date" id="latest_issue_date" value="<?php echo isset($latestIssuedate) ? $latestIssuedate : ''; ?>" readonly>
            <?php if ($remainingQuantity > 0) : ?>
                <button type="submit" name="accept" <?php echo $acceptDisabled; ?>>Reserve</button>
            <?php endif; ?>
        </form>
    </div>
    <footer class="bg-light d-flex flex-wrap p-1 justify-content-between footer">
			<div>
				<p>Follow:</p>
				<ul class="items">
					<li><a href="https://twitter.com/GCTCPORTAL"><h3><i class="fa-brands fa-twitter"></i></h3></a></li>
					<li><a href="https://www.facebook.com/groups/gctcportal"><h3><i class="fa-brands fa-facebook"></i></h3></a></li>
					<li><a href="https://www.instagram.com/gctcportal"><h3><i class="fa-brands fa-instagram"></i></h3></a></li>
				</ul>
			</div>
		</footer>
    <!-- Your existing scripts for the side menu and logout button -->
    <!-- ... -->
</body>
</html>
