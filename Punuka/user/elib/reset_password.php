<?php
session_start();
include 'header.php';
include "db_conn.php";
$full_name = $_SESSION['full_name'];
$location = $_SESSION['location'];
?>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="media/js/jquery.js"></script>
		<link rel="stylesheet" href="assets/css/sweetalert.css" />
		<script src="assets/js/sweetalert.min.js"></script>
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
									<a href="#" class="logo"><strong>Reset Password</strong> </a>
								</header>
							<!-- Banner -->
							<!-- Section -->
								<section>
											
<form action='' method='POST'>
<center><p>
<div style="text-align: left;">
<input type="hidden" name="full_name" value="<?php echo "$full_name" ?>"></br>
</div> 
<button type='submit' class="button special" name='submit' value='Reset Password'></button></br></br>
</center>
</form>

<?php
if (isset($_POST['submit'])) {
	$suggest_author = $_POST['suggest_author'];
	$suggest_title = $_POST['suggest_title'];
	$suggest_link = $_POST['suggest_link'];
	$full_name = $_POST['full_name'];
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>