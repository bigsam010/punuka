<?php
session_start();
include 'header.php';
include "db_conn.php";
$staff_id = $_SESSION['staff_id'];
$e_mail = $_SESSION['user'];
$full_name = $_SESSION['full_name'];
$location = $_SESSION['location'];
?>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="assets/js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
		<script src="assets/js/sweetalert.min.js"></script>
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>

	</head>
	<body>
														
<?php
$currentdate=date('Y-m-d');
?>
	<!-- Wrapper -->
			<div id="wrapper">				<!-- Main -->
					<div id="main">
						<div class="inner">							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Suggest Book</strong> </a>
								</header>						<!-- Banner -->
								<!-- Section -->
								<section>													
<form action='' method='POST'>

<center>
<p>Suggest a new book that is of crucial need, but is currently not in the Punuka Library Collection</p>
<p class="pom"><label class="lab">Author:</label><input class="oop tit" name="suggest_author" placeholder='Enter authors name' required></p>
<p class="pom"><label class="lab">Title:</label><input  class="oop tit" name="suggest_title" placeholder='Enter book title' required></p>
<input type="hidden" name="suggest_date" value="<?php echo "$currentdate"; ?>" required>
<input type="hidden" name="full_name" value="<?php echo "$full_name" ?>"></br>
<input type='submit' class="button special" name='submit' value='Suggest' ></br></br>
</center>
</form>
<?php
if(isset($_POST["submit"])){
	$suggest_author = $_POST["suggest_author"];
	$suggest_title = $_POST["suggest_title"];
	$suggest_date = $_POST["suggest_date"];
	$full_name = $_POST["full_name"];
	$query = $mysqli->query ("insert into suggest (suggest_author,suggest_title,location,full_name,suggest_date) values ('$suggest_author' , '$suggest_title' , '$location','$full_name' , NOW())"); 
	if ($query===TRUE) {
		echo "<script>swal({
  title: 'Thanks!',
  text: 'Your Book suggestion has been recieved.',
  type: 'success',
  timer: 2000,
  showConfirmButton: false
});</script>";
	}
}
?>
				</section>
					</div>
					</div>
				<!-- Sidebar -->
						<!-- Menu -->
<?php include 'menu2.php'; ?>	
						<!-- Section -->
							<!-- Footer -->
			</div>
		<!-- Scripts -->
			
			<script src="assets/js/main.js"></script>
	</body>
</html>