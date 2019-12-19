<?php

include "db_conn.php";
$accessNum = $_GET["accessNum"];
$full_name = $_GET["full_name"];
$date = $_GET["date"];
$due_date = $_GET["due_date"];

$resultset = $mysqli->query("SELECT * FROM users where full_name= '$full_name'");
if ($resultset->num_rows > 0){
while ($rows = $resultset->fetch_assoc())
{
$staff_id = $rows['staff_id'];
$e_mail= $rows['e_mail'];
$location= $rows['location'];
}
}

$resultset1 = $mysqli->query("SELECT * FROM entry where accessNum= '$accessNum' and location='$location'");
if ($resultset1->num_rows > 0){
while ($rows = $resultset1->fetch_assoc())
{
$title= $rows['title'];
$id= $rows['id'];
$status2= $rows['status2'];
}
}


	 $check_book = $mysqli->query ("select * from entry where accessNum = '$accessNum' and (status2 = 'requested' and location='$location')");
 
 if ($check_book->num_rows>0){
  

   $query = $mysqli->query ("update entry set status2 = 'borrowed' where accessNum='$accessNum' and location='$location'");
	$query3 = $mysqli->query ("update borrow_request set request = 'granted' where accessNum = '$accessNum' and location='$location'");
 $query2 = $mysqli->query ("insert into borrowers (staff_id,full_name,title,accessNum,e_mail,id,due_date,location,date) values ('$staff_id','$full_name','$title','$accessNum','$e_mail','$id','$due_date','$location',NOW())");
 ?> 
<!DOCTYPE html>
<html>
<head>
<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<script src="assets/media/js/jquery.js"></script>
		
		<style>
	.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/loading_big1.gif') 50% 50% no-repeat rgb(249,249,249);
}
	</style>
</head>
<body>
	<div class="loader"></div>
	
<input type="hidden" name="staff_id" value="<?php echo "$staff_id"; ?>" />
<input type="hidden" id="full_name" value="<?php echo "$full_name"; ?>" />
<input type="hidden" id="title" value="<?php echo "$title"; ?>" />
<input type="hidden" id="date" value="<?php echo "$due_date"; ?>" />
<input type="hidden" name="location" value="<?php echo "$location"; ?>" />

<td><input type="hidden" name="id" value="<?php echo "$accessNum"; ?>" /></td>
<td><input type="hidden" id="e_mail" value="<?php echo "$e_mail"; ?>" /></td>
<td><input type="hidden" name="user" value="<?php echo "$id"; ?>" /></td>
<td><input type="hidden" name="stat" value="<?php echo "$status2"; ?>" /></td>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
</body>
</html>
<?php
/* 
        $to = $e_mail; 

	  $subject = "Book Borrowers detail";
	  
	  $message = "You have successfully borrowed ".$title.". The book will be due for return on ".$due_date.". 
	  \nPlease ensure to return book on its due date, you can always come back to renew your subscription. Yow will however be reminded via a mail when its due for return
	  \nThank you.";
	  
	  $header = "From: libraryapp@punuka.com \r\n";
	  
	$mail = mail($to, $subject, $message, $header);
 exit(); */
 echo"<script>
 (function(){
	 var date = encodeURI(document.getElementById('date').value);
	 var fullName = encodeURI(document.getElementById('full_name').value);
	 var title = encodeURI(document.getElementById('title').value);
	 var email = encodeURI(document.getElementById('e_mail').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('post','../accept_book_mail.php?date='+date+'&fullName='+fullName+'&title='+title+'&email='+email,true);
xml.send();
 })();

</script>
 ";
 
 }

sleep(4);
header( "refresh:0;url=requests.php" );
?>