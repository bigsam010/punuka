<?php
session_start();
	include "db_conn.php";
	
	if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name, location FROM admin WHERE staff_id='$staff_id'");
	if($ad->num_rows == 1){
		while($row = $ad->fetch_assoc()){
			$location= $row['location'];
			$user_name= $row['user_name'];
			$_SESSION["admin"]=$user_name;
		}
	}
?>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<script src="dist/sweetalert.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/soop.js"></script>

	</head>
	<body>
														
<?php
$currentdate=date('Y-m-d');
$na = $mysqli->query("SELECT full_name FROM users WHERE staff_id='$staff_id'");
	if($na->num_rows == 1){
		while($row = $na->fetch_assoc()){
			$full_name= $row['full_name'];
		}
	}
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
<div class="diff">
<p>Suggest a new book that is of crucial need, but is currently not in the Punuka Library Collection</p>
<p class="pom"><label class="lab">Author:</label><input class="oop tit" name="suggest_author" placeholder='Enter authors name' required></p>
<p class="pom"><label class="lab">Title:</label><input  class="oop tit" name="suggest_title" placeholder='Enter book title' required></p>
<input type="hidden" name="full_name" value="<?php echo "$full_name" ?>">
<input type='submit' class="button special" name='submit' value='Suggest'>
</div>
</form>
<?php
if(isset($_POST["submit"])){
	$suggest_author = $_POST["suggest_author"];
	$suggest_title = $_POST["suggest_title"];
	$full_name = $_POST["full_name"];
	$query = $mysqli->query ("insert into suggest (suggest_author,suggest_title,location,full_name,suggest_date) values ('$suggest_author' , '$suggest_title' , '$location','$full_name' , NOW())");
	if ($query===TRUE) {
		echo "<script>swal({
  title: 'Thanks!',
  text: 'Your Book suggestion has been recieved.',
  type: 'success',
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='suggest_books.php';
},2000);
</script>";
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