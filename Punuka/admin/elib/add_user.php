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
		<script src="assets/js/soop.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
														
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


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Add User</strong> </a>
																				<ul class="icons">
										
									</ul>

								</header>

							<!-- Banner -->


							<!-- Section -->
								<section>
<?php
$getId = $mysqli->query("SELECT id_staff, staff_id FROM users ORDER BY id_staff DESC LIMIT 1");

if ($getId->num_rows !=0){


while ($rows = $getId->fetch_assoc())

{

$display_id = $rows ['staff_id'];
$stuff=substr($display_id,2);
$deal = $stuff+1;
$real_deal = "PU".$deal;
}

}


?>

																
<form action='' method='POST'>
<div class="diffe">
<p class="pom"><label class="lab tam">Fullname:</label><input class="oop tit" name='full_name'required></p>
<p class="pom"><label class="lab tam">Email:</label><input class="oop tit" name="e_mail" required></p>
<p class="pom"><label class="lab tam">Staff ID:</label><input class="oop tit" name='staff_id' value="<?=$real_deal?>" disabled></p>
<p class="pom"><label class="lab tam">Password:</label><input class="oop tit" name="password" required></p>
<p class="pom"><label class="lab tam">User Location:</label><select class="oop loc select" name="location" required>
	<?php
		if($user_name == 'Lagos-admin'){
			echo"<option>Lagos</option>";
		}elseif($user_name == 'Abuja-admin'){
			echo"<option>Abuja</option>";
		}elseif($user_name == 'Asaba-admin'){
			echo"<option>Asaba</option>";
		}else{
			echo"<option>Abuja</option>
			<option>Asaba</option>
			<option>Lagos</option>
			";
		}
	?>
</select></p>
<input type='submit' class="button special" name='submit' value='Add User' ></br></br>
</div>
</form>





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
<?php

 if(isset($_POST["submit"])){
  $full_name = $_POST["full_name"];
    $e_mail = $_POST["e_mail"];
 $staff_id = $real_deal;
 $password = $_POST["password"];
 $location = $_POST["location"];

 

	
    $check_id = $mysqli->query ("select * from users where staff_id = '$staff_id' ");

if ($check_id->num_rows>0){
echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! staff id $staff_id already in use by another user.',
  type: 'error',
  timer: 5000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='add_user.php';
},5000);
</script>";
exit();
}


    $check_mail = $mysqli->query ("select * from users where e_mail = '$e_mail'");

if ($check_mail->num_rows>0){
echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! email $e_mail already in use by another user',
  type: 'error',
  timer: 5000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='add_user.php';
},5000);
</script>";
exit();
}


 $query = $mysqli->query ("insert into users (full_name,e_mail,staff_id,password,login,location,date,profile_pic) values ('$full_name','$e_mail','$staff_id','$password','Enabled','$location',NOW(),'da.jpg')");
 if ($query===TRUE){
echo "<input type=\"hidden\" id=\"e_mail\" value=\"$e_mail\" />";
echo "<input type=\"hidden\" id=\"password\" value=\"$password\" />";
 echo"<script>
 (function(){
	 var password = encodeURI(document.getElementById('password').value);
	 var email = encodeURI(document.getElementById('e_mail').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('get','../add_user_mail.php?password='+password+'&email='+email,true);
xml.send();
 })();
</script>
 ";

echo "<script>window.open('add_userConfirm.php?e_mail=$e_mail&full_name=$full_name','_self')</script>";
	  

 }
   

 }




?>

	</body>
</html>