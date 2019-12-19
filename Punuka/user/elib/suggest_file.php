<?php
session_start();
include 'header.php';
include "db_conn.php";
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
		<!-- <link rel="stylesheet" href="assets/css/site-demos.css" /> -->
		<script src="media/js/jquery.js"></script>
		<!-- <script src="assets/js/jquery.validate.min.js"></script> -->
		<!-- <script src="assets/js/additional-methods.min.js"></script> -->
		<link rel="stylesheet" href="assets/css/sweetalert.css" />
		<script src="assets/js/sweetalert.min.js"></script>
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>
	</head>
	<body>
														
<?php $currentdate=date('Y-m-d'); ?>
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
					<div id="main">
						<div class="inner">
							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Suggest File</strong> </a>
								</header>
							<!-- Banner -->
							<!-- Section -->
								<section>
											
<form action='' method='POST' id="suggest">
<p style="margin-left:20%;">Suggest a file that is of crucial need, but is currently not in the Punuka Library Collection</p>
<center>
<p class="pom"><label class="lab">Author:</label><input class="oop tit" name="suggest_author" placeholder='Enter authors name' required></p>
<p class="pom"><label class="lab">Title:</label><input  class="oop tit" name="suggest_title" placeholder='Enter book title' required></p>
<p class="pom"><label class="lab">File Link/url:</label><input class="oop tit" type="website" name="suggest_link" placeholder='Enter book link'></p>
<input type='submit' class="button special" name='submit' value="Suggest File">
</center>
</form>
<?php
if (isset($_POST['submit'])) {
	$suggest_author = $_POST['suggest_author'];
	$suggest_title = $_POST['suggest_title'];
	$suggest_link = $_POST['suggest_link'];
$query = $mysqli->query ("insert into files_suggest (suggest_author,suggest_title,location,suggest_name,suggest_date,suggest_link) values ('$suggest_author' , '$suggest_title' ,'$location', '$full_name' , NOW(),'$suggest_link')");
 if ($query===TRUE){
 ?>
 <script>
 swal({
  title: 'Thanks!',
  text: 'Your File suggestion was successful.',
  type: 'success',
  timer: 2000,
  showConfirmButton: false
});
 </script>
 <?php 
  	}
  	else {
  		?>
  		 <script>
 			swal('Error','Your file suggestion failed','error');
 		</script>
  	<?php
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