<?php
	session_start();
	include "db_conn.php";
	if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id' AND status='active'");
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
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src="assets/media/js/jquery.js"></script>
	<script src="assets/js/soop.js"></script>
	</head>
	<body>
														


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Upload file</strong> </a>
								</header>

							<!-- Banner -->
<?php

$query = $mysqli->query ("SELECT (view) FROM files where view = 'enabled'");
$rows = $query->num_rows;





?>


							<!-- Section -->
								<section>


<div class="box-f">
<form style="height:auto; width:90%; margin:0 auto;" enctype="multipart/form-data" method="post" action="">
<p class="pom"><label class="lab">Select file</label> <input name="image_file" size="30" type="file" class="file" style="margin-left:5%;"></p>

<p class="pom"><label class="lab">Title:</label><input class="oop tit" name="title" required/></p>

<p class="pom"><label class="lab">Author:</label><input class="oop aut" name="author" required/></p>

<p class="pom"><label class="lab">Edition:</label><input class="oop aut" name="edition" required/></p>

<p class="pom"><label class="lab">Subject:</label><input class="oop sub" name="subject" required/></p>

<p class="pom"><label class="lab">Publisher:</label><input class="oop pub" name="publisher" required/></p>

<p class="pom"><label class="lab">Year:</label><input class="oop y" name="year" required/></p>

<div class="fox">
<button class="mo k" style="background:#5A0524;box-shadow:inset 0 0 0 2px #5A0524;" name="sing">Upload</button>
</div>
</form>
</div>
<?php
if(isset($_POST['sing'])){
	
   $title = $_POST["title"];
 $author = $_POST["author"];
 $edition = $_POST["edition"];
 $subject = $_POST["subject"];
 $publisher = $_POST["publisher"];
 $year = $_POST["year"];
 
 
 
 
   if(isset($_FILES['image_file'])){
      $errors= array();
      $file_name = $_FILES['image_file']['name'];
	  $file_url = "../../uploads/".$file_name;
      $file_size =$_FILES['image_file']['size'];
      $file_tmp =$_FILES['image_file']['tmp_name'];
      $file_type=$_FILES['image_file']['type'];
      $file_exti=explode('.',$_FILES['image_file']['name']);
	  $file_ext=strtolower(end($file_exti));
      
      $expensions= array("pdf","doc");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF or DOC file.";
		 echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! Only PDF and DOC files can be uploaded.',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='fuploadfile.php';
},3000);
</script>";

//header( "refresh:2;url=uploadfile.php" );
      }
      
      if($file_size > 30097152){
         $errors[]='File size must be excately 30 MB';
		 echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! file is too large',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='fuploadfile.php';
},3000);
</script>";
      }
      
      if(empty($errors)==true){
		  $ron=$mysqli->query("SELECT * from files where file_url='$file_url'");
		  if($ron->num_rows>0){
			  echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! file already exist',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='fuploadfile.php';
},3000);
</script>";
		  }else{
         if(move_uploaded_file($file_tmp,$file_url)){
         			echo "<script>swal({
  title: 'Success alert!',
  text: 'File uploaded successfully.',
  type: 'success',
  timer: 3000,
  showConfirmButton: false
});</script>";
		 $mysqli->query("INSERT INTO files (title,author,edition,subject,publisher,year,file_name,file_url,view) VALUES ('$title','$author','$edition','$subject','$publisher','$year','$file_name','$file_url','enabled')");
      }else{
         print_r($errors);
      }
	}
   }
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