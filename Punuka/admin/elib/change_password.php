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
		<script src="dist/sweetalert.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src="assets/js/soop.js"></script>
	</head>
	<body>
														
<?php
$currentdate=date('Y-m-d');

/* $resultset = $mysqli->query("SELECT * FROM users where e_mail = '$e_mail'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$staff_id = $rows ['staff_id'];
$e_mail = $rows ['e_mail'];
$full_name = $rows ['full_name'];
$password=$rows ['password'];


}


} */


?>


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Change Password</strong> </a>
																				<ul class="icons">
										<li><a href="index.php?e_mail=<?php echo "$e_mail&staff_id=$staff_id";?> "><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->


							<!-- Section -->
								<section>

																
<form action='' method='POST'>

<center>
<input type="password" size='70' name='password' placeholder='enter present password' required>
<input type="password" name="password1" placeholder='enter new password' required>
<input type="password" name="password2" placeholder='confirm new password' required><br/>
<input type='submit' class="button special" name='submit' value='Change Password' ></br></br>
</center>
</form>
<?php
	include "db_conn.php";

 if(isset($_POST["submit"])){
  $password = $_POST["password"];
  $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
	
    $check_password = $mysqli->query ("select * from users where staff_id = '$staff_id' and password = '$password'");

if ($check_password->num_rows<=0){
echo "<script>
sweetAlert('Oops...', 'The current password entered does not match your exisiting password!', 'error');
</script>";

}else if($password1==$password2){
 $query = $mysqli->query ("update users set password = '$password1' where staff_id = '$staff_id' ");
	if ($query===TRUE){
		echo "<script>swal({
  title: 'Success!',
  text: 'User data updated successfully.',
  type: 'success',
  timer: 5000,
  showConfirmButton: false
});</script>";
	}
  }else{
	echo "<script>
	sweetAlert('Oops...', 'new passwords does not match each other!', 'error');
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
			
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>