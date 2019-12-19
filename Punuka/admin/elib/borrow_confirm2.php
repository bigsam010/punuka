<?php
	include "db_conn.php";

	$staff_id=$_GET['staff_id'];
	$title=$_GET['title'];
	$due_date=$_GET['due_date'];
	$e_mail=$_GET['e_mail'];


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
									<a href="#" class="logo"><strong>Borrow a Book</strong> </a>
																		<ul class="icons">
										<li><a href="index.php"><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->




							<!-- Section -->
								<section>
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



	include "db_conn.php";

$resultset = $mysqli->query("SELECT * FROM users where staff_id= '$staff_id'");



if ($resultset->num_rows !=0){



while ($rows = $resultset->fetch_assoc())
{

$staff_id = $rows['staff_id'];
$full_name= $rows['full_name'];
$e_mail= $rows['e_mail'];
 
}
 


}



?>




																
<td><input type="hidden" name="staff_id" value="<?php echo "$staff_id"; ?>" /></td>
<td><input type="hidden" name="full_name" value="<?php echo "$full_name"; ?>" /></td>
<td><input type="hidden" name="title" value="<?php echo "$title"; ?>" /></td>

<td><input type="hidden" name="e_mail" value="<?php echo "$e_mail"; ?>" /></td>
<td><input type="hidden" name="due_date" value="<?php echo "$due_date"; ?>" /></td>


 <?php

 

 
 
 
 $query2 = $mysqli->query ("insert into borrowers (staff_id,full_name,title,e_mail,due_date,date) values ('$staff_id','$full_name','$title','$e_mail','$due_date',NOW())");

  echo "<h3 align = center> You have successfully borrowed $title</h3>";
echo "<center>";
  echo"<a href ='borrow_book.php?e_mail=$e_mail&staff_id=$staff_id' class='button special'>borrow another book</a>";
echo"</center>";
  
  
        $to = $e_mail; 

	  $subject = "Book Borrowers detail";
	  
	  $message = "You have successfully borrowed ".$title.". The book will be due for return on ".$due_date.". 
	  \nPlease ensure to return book on its due date, you can always come back to renew your subscription. Yow will however be reminded via a mail when its due for return
	  \nThank you.";
	  
	  $header = "From: libraryapp@punuka.com \r\n";
	  
	$mail = mail($to, $subject, $message, $header);
 exit();

 
 
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