<?php
	include "db_conn.php";
	
	session_start();
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
	

	$staff_idd=$_GET['staff_id'];
	$accessNums=unserialize($_GET['accessNum']);
	$due_dates=unserialize($_GET['due_date']);
	$due_d=($_GET['due_date']);


	$arrlength = count($accessNums);
	$datelength = count($due_dates);
	

   

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
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/soop.js"></script>
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
$currentdate=date('d-m-Y');


$date_arr=explode('-',$currentdate);


$next_date= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+1,$date_arr[0]));

$next_date2= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+2,$date_arr[0]));

$next_date3= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+3,$date_arr[0]));

$next_date4= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+4,$date_arr[0]));

$next_date5= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+5,$date_arr[0]));

$next_date6= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+6,$date_arr[0]));

$next_date7= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+7,$date_arr[0]));

$next_date8= Date("d-m-Y",mktime(0,0,0,$date_arr[1],$date_arr[2]+8,$date_arr[0]));



	include "db_conn.php";

$resultset = $mysqli->query("SELECT * FROM users where staff_id= '$staff_idd'");



if ($resultset->num_rows !=0){



while ($rows = $resultset->fetch_assoc())
{

$staff_idd = $rows['staff_id'];
$full_name= $rows['full_name'];
$e_mail = $rows['e_mail'];
$location= $rows['location'];
 
}
 
for($x = 0; $x < $arrlength; $x++){
	$accessNum = $accessNums[$x];
	$due_date = $due_dates[$x];
	$resultset1 = $mysqli->query("SELECT * FROM entry where accessNum= '$accessNum'");


if ($resultset1->num_rows !=0){



while ($rows = $resultset1->fetch_assoc())
{

$accessNum = $rows['accessNum'];
$title[] = $rows['title'];
$titles = serialize($title);
$id= $rows['id'];
$status2= $rows['status2'];
$blocation = $rows['location'];
 
}
 


}

?>




																



 <?php
	
 

 
 
	  $check_book = $mysqli->query ("select * from entry where accessNum = '$accessNum' and status2 = 'available' ");
 
 if ($check_book->num_rows>0){
  

   $query = $mysqli->query ("update entry set status2 = 'borrowed' where accessNum = '$accessNum'");
 
 $query2 = $mysqli->query ("insert into borrowers (staff_id,full_name,title,accessNum,e_mail,id,due_date,location,date) values ('$staff_idd','$full_name','$title[$x]','$accessNum','$e_mail','$id','$due_date','$blocation',NOW())");

  echo "<h3 align = center> You have successfully borrowed $title[$x]</h3>";

  
  /* 
        $to = $e_mail; 

	  $subject = "Book Borrowers detail";
	  
	  $message = "You have successfully borrowed ".$title.". The book will be due for return on ".$due_date.". 
	  \nPlease ensure to return book on its due date, you can always come back to renew your subscription. Yow will however be reminded via a mail when its due for return
	  \nThank you.";
	  
	  $header = "From: libraryapp@punuka.com \r\n";
	  
	$mail = mail($to, $subject, $message, $header);
 exit(); */

 

 
 }else{
echo "<h3 align = center>$title has already been borrowed by another user</h3>";
echo "<center>";
  echo"<a href ='borrow_book.php' class='button special'>borrow another book</a>";
echo"</center>";
 exit();
 } 
	   
}
?>
<input type="hidden" name="staff_id" value="<?php echo "$staff_idd"; ?>" />
<input type="hidden" id="full_name" value="<?php echo "$full_name"; ?>" />
<p type="hidden" id="title" value="<?php echo $titles; ?>"></p>
<input type="hidden" id="date" value="<?php echo "$due_date"; ?>" />
<input type="hidden" name="location" value="<?php echo "$location"; ?>" />

<td><input type="hidden" name="id" value="<?php echo "$accessNum"; ?>" /></td>
<td><input type="hidden" id="e_mail" value="<?php echo "$e_mail"; ?>" /></td>
<td><input type="hidden" name="user" value="<?php echo "$id"; ?>" /></td>
<td><input type="hidden" name="stat" value="<?php echo "$status2"; ?>" /></td>
<?php

echo"<script>
  (function(){
	 var date = '$due_d';
	 var fullName = encodeURI(document.getElementById('full_name').value);
	 var title = '$titles';
	 var email = encodeURI(document.getElementById('e_mail').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('post','../borrow_book_mail.php?date='+date+'&fullName='+fullName+'&title='+title+'&email='+email,true);
xml.send();
 })(); 
</script>
 ";
/*  echo"<script>
 window.open('../borrow_book_mail.php?date=$due_date&fullName=$full_name&title=$titles&email=$e_mail','_self');
 </script>
 "; */

echo "<center>";
  echo"<a href ='borrow_book.php' class='button special'>borrow another book</a>";
echo"</center>";
	
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