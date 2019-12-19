<?php
	session_start();
	include "db_conn.php";
	if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id'");
	if($ad->num_rows == 1){
		while($row = $ad->fetch_assoc()){
			$user_name= $row['user_name'];
			$_SESSION["admin"]=$user_name;
		}
	}
	

	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/soop.js"></script>
	</head>
	<body>
														


		<!-- Wrapper -->
			<div id="wrapper">
<?php
$currentdate=date('Y-m-d');

$resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$location = $rows ['location'];


}


}


?>
				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Manual Upload</strong> </a>
								</header>

							<!-- Banner -->
<?php

$query = $mysqli->query ("SELECT (view) FROM entry where view = 'enabled' AND location='$location'");
$rows = $query->num_rows;





?>


							<!-- Section -->
								<section>


<div class="box-f">
<form style="height:auto; width:90%; margin:0 auto;" method="post" action="submit.php" onsubmit="swal({
  title: 'Success!',
  text: 'Book added successfully.',
  type: 'success',
  timer: 5000,
  showConfirmButton: false
});">
<p class="pom"><label class="lab b">Title:</label><input class="oop tit" name="title" required/></p>

<p class="pom"><label class="lab b">Author:</label><input class="oop aut" name="author" required/></p>

<p class="pom"><label class="lab b">Edition:</label><input class="oop aut" name="edition" required/></p>

<p class="pom"><label class="lab b">Location:</label><select class="oop loc select" name="location" required>
	<?php
		if($user_name=='Lagos-admin'){
			echo"<option>Lagos</option>";
		}elseif($user_name=='Abuja-admin'){
			echo"<option>Abuja</option>";
		}elseif($user_name=='Asaba-admin'){
			echo"<option>Asaba</option>";
		}else{
			echo"
			<option>Lagos</option>
			<option>Abuja</option>
			<option>Asaba</option>
			";
		}
	?>
</select></p>

<p class="pom"><label class="lab b">Position:</label><input class="oop pos" name="position" placeholder="Shelf C Row 20" required/></p>

<p class="pom"><label class="lab b">Accession No:</label><input class="oop access" name="accessNum" required/></p>

<p class="pom"><label class="lab b">Subject:</label><input class="oop sub" name="subject" required/></p>

<p class="pom"><label class="lab b">Publisher:</label><input class="oop pub" name="publisher" required/></p>

<p class="pom"><label class="lab b">Year:</label><input class="oop y" name="year" required/></p>

<div class="fox">
<button class="mo k" style="background:#5A0524;box-shadow:inset 0 0 0 2px #5A0524;">Submit</button>
</div>
</form>
</div>



						</section>

						</div>
					</div>

				<!-- Sidebar -->

							<!-- Menu -->
							<?php 
	include 'menu2.php';
	
?>	


							<!-- Section -->

							<!-- Footer -->

			</div>

		<!-- Scripts -->
	
			<script src="dist/sweetalert.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>