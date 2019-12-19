<?php
session_start();
include 'header.php';
include "db_conn.php";
$e_mail = $_SESSION["user"];
$location = $_SESSION['location'];
$check = $mysqli->query("select staff_id from users where e_mail = '$e_mail'");
if ($check->num_rows > 0) {
	while($row = $check->fetch_assoc()){
		$staff_id = $row['staff_id'];
	}
}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet" href="assets/css/main.css" />
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="assets/css/st.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<script src="assets/js/jquery.min.js"></script>
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
									<a href="#" class="logo"><strong>Upload ProfilePicture</strong> </a>
									<ul class="icons">
									</ul>
								</header>
								<section>		
<form action="" method="POST" enctype="multipart/form-data">
<strong>Profile Picture</strong>
<div class="pp">
	<input type='file' name='profile_pic' required>
	<input type='submit' class="button special" name='submit_pic' value='Upload Profile Picture' />
</div>
</form>
<?php
if(isset($_POST['submit_pic']))
if(isset($_FILES['profile_pic']))
 {
  $imgFile = $_FILES['profile_pic']['name'];
  $tmp_dir = $_FILES['profile_pic']['tmp_name'];
  $imgSize = $_FILES['profile_pic']['size'];
  {
   $upload_dir = 'user_images/'; // upload directory
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
     // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
     // rename uploading image
   $userpic = $staff_id.".".$imgExt;
      // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }
    // if no error occured, continue ....
  if(!isset($errMSG))
  {
	$query = $mysqli->query("UPDATE users SET profile_pic='$userpic' WHERE e_mail = '$e_mail'");   
   if($query==TRUE)
   {
    $successMSG = "new record succesfully inserted ...";
   echo "<script>swal({
  title: 'Success!',
  text: 'Profile Picture updated successfully.',
  type: 'success',
  timer: 3000,
  showConfirmButton: false
});</script>";
   }
   else
   {
    $errMSG = "error while inserting....";
   }
  }
 }
?>
						</section>
						</div>
					</div>
				<!-- Sidebar

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