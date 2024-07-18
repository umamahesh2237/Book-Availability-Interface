<?php
$connection = mysqli_connect("localhost", "root", "", "library");
function sanitizeInput($input)
{
    global $connection;
    return mysqli_real_escape_string($connection, $input);
}
// Initialize $remainingQuantity
$remainingQuantity = '';
$latestIssueDate = '';
if (isset($_POST['search'])) {
    $bookName = sanitizeInput($_POST['book']);
    $query = "SELECT qty, date FROM mainbook WHERE bookname = '$bookName'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $remainingQuantity = $row['qty'];
        $latestIssueDate = $row['date'];

        if ($remainingQuantity > 0) {
            $query = "UPDATE mainbook SET qty = qty - 1, date = NOW() WHERE bookname = '$bookName'";
            mysqli_query($connection, $query);

            // Fetch the updated quantity and latest_issue_date
            $query = "SELECT qty, date FROM mainbook WHERE bookname = '$bookName'";
            $result = mysqli_query($connection, $query);
            $updatedRow = mysqli_fetch_assoc($result);
            $remainingQuantity = $updatedRow['qty'];
            $latestIssueDate = $updatedRow['date'];

            // Redirect to profile.php with book details as URL parameters
            header("Location: profile.php?book=" . urlencode($bookName) . "&Date=" . urlencode($latestIssueDate));
            exit();
        } else {
            // If the quantity is zero
            echo '<script> alert("Book is not available."); </script>';
        }
    } else {
        // If the book is not found in the database
        $remainingQuantity = 'Book not found';
        $latestIssueDate = 'N/A';
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
  <script>
	function openNav() {
	 document.getElementById("side-menu").style.width = "300px";
	 document.getElementById("content-area").style.marginLeft = "300px"; 
	}

	function closeNav() {
	 document.getElementById("side-menu").style.width = "0";
	 document.getElementById("content-area").style.marginLeft= "0";  
	}
	// function LoginPage() {
	// 	console.log("hi");
	// 	window.location.href="LoginPage.html";
	// }
	</script>
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
	  <a href="profile.php"><i class="fa-solid fa-user"></i>Profile</a>
		</div>
	</div>
	<div id="content-area">
		<span onclick="openNav()" style="font-size:30px;cursor:pointer">☰ </span>
		<a href="LoginPage.html"><h1 align="right" style="font-family:Playfair Display; color:black;">LOGOUT</h1></a>
	</div>
	<div class="container">
    
				<div class="row justify-content-center">
				   <div class="col-md-8">
					<h1 align="center">Geethanjali College of Engineering and Technology Library</h1>					   
					   <div class="input-group mb-3">
			  <input type="text" class="form-control input-text" placeholder="Search for a book..." id="book" required>
			  <div class="input-group-append">
				<button class="btn btn-warning btn-lg" type="submit" name="search"><i class="fa fa-search"></i></button>
			  </div>
            </div>
			<div class="mb-3">
            <label for="qy" class="col-cm-2 col-form-label text-black"><h4>Book Name:</h4></label>
				<div class="col-sm-8" >
                <input type="text" name="quantity" id="quantity" style="width: 500px;" value='<?php echo isset($bookName) ? $bookName : 'NOT FOUND'; ?>' readonly>
				</div> <br>
				<label for="qy" class="col-cm-2 col-form-label text-black"><h4>Quantity:</h4></label>
				<div class="col-sm-8" >
                <input type="text" name="quantity" id="quantity" style="width: 500px;" value='<?php echo isset($remainingQuantity) ? $remainingQuantity : 'NOT FOUND'; ?>' readonly>
				</div>
			  </div>
			  <div class>
				<label for="qy" class="col-cm-2 col-form-label text-black"><h4>Latest Issue Date:</h4></label>
				<div class="col-sm-8 d-flex align-items-center">
                <input type="text" name="latest_issue_date" id="latest_issue_date" style="width: 500px;" value="<?php echo isset($latestIssueDate) ? $latestIssueDate : 'NOT FOUND'; ?>" readonly>
                <?php if ($remainingQuantity > 0) : ?>
                <br>
                <button type="submit" name="accept">Accept</button>
                <?php endif; ?>
				</div>
			  </div>
				   </div>        
				</div>
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
	</form>
</body>
</html>