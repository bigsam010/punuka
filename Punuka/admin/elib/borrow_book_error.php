<?php
	header( "refresh:2;url=borrow_book.php" );
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
		<link rel="stylesheet" href="assets/css/style.css" />
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
									<a href="#" class="logo"><strong>Borrow a Book</strong></a>
									<ul class="icons">
										<li><a href="index.php"><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->
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


<center>
	<p style="color:red;">The accession Number is wrong</P>											
<form action='' method='POST'>
Fill in the following:
<div class="select-wrapper">

 <td><select name="staff_id" id="demo-category" required>  
                <option value="">Staff Name</option>  
                <?php echo load_names(); ?>  
           </select></td>

      </td></tr>
	<?php  
 function load_names()  
 {  
include "db_conn.php";
      $output = '';  
      $sql = "SELECT * FROM users ORDER BY full_name";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["staff_id"].'">'.$row["full_name"].'</option>';  
      }  
      return $output;  
 }  
 ?>  
  
<input type="tel" size='70' name='accessNum' placeholder='enter book accession number' required>
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
  
  $accessNum = $_POST["accessNum"];
   $due_date = $_POST["due_date"];

 

    $check_access = $mysqli->query ("select * from entry where accessNum = '$accessNum'");

if ($check_access->num_rows<=0){
echo "<script>
window.open('borrow_book.php?staff_id=$staff_id&due_date=$due_date','_self');
</script>";
exit();
}



$query1 = $mysqli->query ("insert into borrowers1 (staff_id,e_mail,accessNum,due_date,date) values ('$staff_id' , '$e_mail' , '$accessNum' , '$due_date' , NOW())");



  echo "<script>window.open('borrow_confirm.php?staff_id=$staff_id&accessNum=$accessNum&due_date=$due_date','_self')</script>";
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