<?php
include "db_conn.php";
session_start();
if(isset($_SESSION["staff_id"])){
echo"<script>window.open('admin/elib/index.php','_self')</script>";	
}
?>


<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
<link rel="stylesheet" href="assets/css/style.css" />

  
  <script src="assets/javascript/jquery.js"></script>
  <script src="assets/javascript/bootstrap.min.js"></script>
	<script src="assets/javascript/jquery.js"></script>
  <script src="assets/javascript/bootstrap.min.js"></script>
  
  <script src="assets/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/dist/sweetalert.css">
<style>
.hush{
	display:none;
	position:fixed;
	height:230px;
	width:30%;
	left:68%;
	bottom:30%;
	background:#fff;
	border-radius:5px;
	z-index:1000000;
}
</style>
	</head>
	<body>
	<center>
<div class="hush">
<div style="width:98%;">
<form method='POST' action=''>
        <p style="font-size: 1.5rem; color:#333333;">Enter your email address here<br />to retrieve your password</p>
        <div style="padding: 0; margin-top:-5px;" >
          <input style="border-color:#A9A9A9;" type="email" placeholder="enter email" name="someValue" required>
        </div>
		<div style="display:flex; flex-direction:column;">
        <button style="margin-top:5px; margin-bottom:5px; width:50%;" name='submitit'>SUBMIT</button>
        <button style="background:red; width:50%;" class="close">Close</button>
		</div>
</form>
</div>
</div>
</center>
<?php
if(isset($_POST['submitit'])){
	$someValue = $_POST['someValue'];
	$user = $mysqli->query ("select e_mail, password from users where e_mail = '$someValue'");
	if ($user->num_rows >0){
	echo "<input type=\"hidden\" id=\"someValue\" value=\"$someValue\" />";
	while($rows = $user->fetch_assoc()){
			$pass= $rows['password'];
			echo "<input type=\"hidden\" id=\"passin\" value=\"$pass\" />";
		}
 echo"<script>swal({
  title: 'Success!',
  text: 'Your password has been sent to you email',
  type: 'success',
  timer: 5000,
  showConfirmButton: false
});</script>
 ";
 echo"<script>
 (function(){
	 var someValue = encodeURI(document.getElementById('someValue').value);
	 var password = encodeURI(document.getElementById('passin').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('get','newAdmin/getPassword_mail.php?someValue='+someValue+'&password='+password,true);
xml.send();

 })();

 
</script>
 ";
 }else{
	echo"<script>swal({
  title: 'Error!',
  text: 'User with this email does not exist',
  type: 'error',
  timer: 5000,
  showConfirmButton: false
});
</script>";

 }
	
	

}
?>
		<!-- Header -->
			<header id="header">
				<h1>Punuka Library App</h1>
				<p>One app that gives you access to the digital library, electronic catalogue<br />
				and the treasury file request system</p>
			</header>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="#">
				<input type="email" name="e_mail" id="email" placeholder="Email Address" value="" required />
				<input type="password"  name="password" id="email" placeholder="password" autocomplete="off" required />
				<input type="submit" name="submit" value="Login" /><br/>
			</form>
			<div class="field text-center">
    <a href="#" class="forgot-link">forgot password?</a>
  </div>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="http://www.twitter.com/punukaattorneys" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="http://www.instagram.com/punukaattorneys" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="http://www.facebook.com/punuka" class="icon fa-facebook"><span class="label">GitHub</span></a></li>
					<li><a href="info@punuka.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					<li><a href="#" class="icon fa-linkedin"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Punuka Attorneys & Solicitors.</li>
				</ul>
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
	<script>
	$(document).ready(function(){
  $(".forgot-link").click(function(){
	$(".hush").fadeIn();
	  });
});
$(document).ready(function(){
	$(".close").click(function(e){
		e.preventDefault();
		$(".hush").fadeOut();
});
});

	</script>
</html>

<?php
	
 
  if(isset($_POST["submit"])){
 $e_mail = $_POST["e_mail"];
 $password = $_POST["password"];


$check_user_name = $mysqli->query ("select staff_id from users where e_mail = '$e_mail' and (password = '$password' and login = 'enabled')");
 
 
if ($check_user_name->num_rows >0){
	while($row = $check_user_name->fetch_assoc()){
		$staff_id = $row['staff_id'];
		$check_if_its_admin = $mysqli->query ("select staff_id from admin where staff_id = '$staff_id' AND status='active'");
		if($check_if_its_admin->num_rows > 0){
			$_SESSION["staff_id"]=$staff_id;
			echo"<script>window.open('admin/elib/index.php','_self')</script>";		
		}else{
			$_SESSION['user'] = $e_mail;
			 echo "<script>window.open ('user/elib/index.php','_self')</script>";
		}
	}
 }else{
	echo"<script>swal({
  title: 'Error!',
  text: 'login details incorrect or priviledge disabled',
  type: 'error',
  timer: 5000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='index.php';
},5000);
</script>";

 } 
}
?>
