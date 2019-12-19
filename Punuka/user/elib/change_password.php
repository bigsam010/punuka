<?php
session_start();
include "db_conn.php";
$e_mail   = $_SESSION["user"];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="assets/js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="assets/css/twitter.css">
		<script src="assets/js/sweetalert.min.js"></script>
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>
	</head>
	<body>

<?php $currentdate = date('Y-m-d');?>
<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
					<div id="main">
						<div class="inner">
							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Change Password</strong> </a>
																				<ul class="icons">
										<li><a href="index.php"><strong>Home</strong> </a></li>
									</ul>
								</header>
							<!-- Banner -->
							<!-- Section -->
								<section>
								<center>
<form action='' method='POST'>
<input style="width:60%;" type="password" size='70' name='password' placeholder='enter present password' required><br/>
<input style="width:60%;" type="password" name="password1" placeholder='enter new password' required><br/>
<input style="width:60%;" type="password" name="password2" placeholder='confirm new password' required><br/>
<input type='submit' class="button special" name='submit' value='Change Password' >
</form>
</center>
<?php
if (isset($_POST["submit"])) {
	$password = $_POST["password"];
	$password1= $_POST["password1"];
	$password2= $_POST["password2"];
	$check_password = $mysqli->query("select * from users where e_mail = '$e_mail' and password = '$password' ");
	if ($check_password->num_rows <= 0) {
		echo "<script>
		swal('Wrong Current password supplied!','Please check Input', 'error');
		</script>";
	} else if ($password1 == $password2) {
	$query = $mysqli->query("update users set password = '$password1' where e_mail = '$e_mail' ");
	if ($query==TRUE) {
		echo "<script>swal({
		  	title: 'Success!',
		  	text: 'User data updated successfully.',
		  	type: 'success',
		  	timer: 3000,
		  	showConfirmButton: false
			});</script>";
		}
	}
	else {
		echo "<script>
	sweetAlert('Oops...', 'new passwords do not match each other!', 'error');
	</script>";
	}
}
?>
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

			
		
			<script src="assets/js/main.js"></script>

	</body>
</html>