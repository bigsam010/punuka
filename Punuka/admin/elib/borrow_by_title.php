<?php
	include "db_conn.php";

	$staff_id=$_GET['staff_id'];
	$due_date=$_GET['due_date'];

	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
														


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Borrow a Book Using Title</strong> </a>
								</header>

							<!-- Banner -->
<?php
echo "<br/>";
echo "<p>Sorry! the accession number you entered is not stringed to any title in the database. Kindly enter the title of the book in the box below. Thank you</p>";
?>
<?php

$currentdate=date('Y-m-d');


$date_arr=explode('-',$currentdate);


$next_date= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+1,$date_arr[0]));

$next_date2= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+2,$date_arr[0]));

$next_date3= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+3,$date_arr[0]));

$next_date4= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+4,$date_arr[0]));

$next_date5= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+5,$date_arr[0]));

$next_date6= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+6,$date_arr[0]));

$next_date7= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+7,$date_arr[0]));

$next_date8= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+8,$date_arr[0]));




?>


							<!-- Section -->
								<section>

<?php
	include "db_conn.php";

$resultset = $mysqli->query("SELECT * FROM users where staff_id = '$staff_id'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$staff_id = $rows ['staff_id'];
$e_mail = $rows ['e_mail'];
$full_name = $rows ['full_name'];


}


}


?>



																
<form action='' method='POST'>
Fill in the following:
<center>
<?php

?>
<input type="text" name="full_name" value="<?php echo "$full_name" ?>">
<input type="text" size='70' name='title' placeholder='enter book title' required>
<input type="hidden" name="e_mail" value="<?php echo "$e_mail" ?>">
<input type="hidden" name="staff_id" value="<?php echo "$staff_id" ?>">

<div class="select-wrapper">
<select name="due_date" id="demo-category" required>
<option value="">Due Date</option>
<option value="">.......</option>
<option value="<?php echo "$next_date"; ?>">1 day</option>
<option value="<?php echo "$next_date2"; ?>">2 days</option>
<option value="<?php echo "$next_date3"; ?>">3 days</option>
<option value="<?php echo "$next_date4"; ?>">4 days</option>
<option value="<?php echo "$next_date5"; ?>">5 days</option>
<option value="<?php echo "$next_date6"; ?>">6 days</option>
<option value="<?php echo "$next_date7"; ?>">7 days</option>
<option value="<?php echo "$next_date8"; ?>">1 week</option>

</select></div></br>
<input type='submit' class="button special" name='submit' value='Borrow' ></br></br>
</center>
</form>
<?php

 if(isset($_POST["submit"])){
  $staff_id = $_POST["staff_id"];
  $e_mail = $_POST["e_mail"];
  
  $title = $_POST["title"];
   $due_date = $_POST["due_date"];
  
 








  echo "<script>window.open('borrow_confirm2.php?staff_id=$staff_id&e_mail=$e_mail&title=$title&due_date=$due_date','_self')</script>";
 exit();
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>