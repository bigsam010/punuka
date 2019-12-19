<?php
include "db_conn.php";
$title = $_POST['title'];
$user = $_POST['user'];
$location = $_POST['location'];
$due_date = $_POST['due_date'];

$currentdate=date('Y-m-d');
$resultset = $mysqli->query("SELECT due_date FROM borrowers where title= '$title' AND location='$location'");

if ($resultset->num_rows !=0){



while ($rows = $resultset->fetch_assoc())
{

$old_date = $rows['due_date'];
 
}
}

$result = $mysqli->query("SELECT e_mail FROM users where full_name= '$user' AND location='$location'");

if ($result->num_rows !=0){



while ($rows = $result->fetch_assoc())
{

$email = $rows['e_mail'];
 
}
}
$cur = strtotime( $currentdate );
$due = strtotime( $due_date );

$current = date( 'Y-m-d', $cur );
$current1 = date_create($current);
$dd = date( 'Y-m-d', $due );
$dd1 = date_create($dd);

$diff=date_diff($dd1,$current1);
$real_diff = (int)$diff->format('%d');

$date3 = date('Y-m-d',strtotime($old_date) + (24*3600*$real_diff));

$query = $mysqli->query ("update borrowers set due_date = '$date3' where title = '$title' AND (full_name ='$user' AND location='$location')");

?>
<!DOCTYPE HTML>
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
<input type="hidden" id="full_name" value="<?php echo "$user"; ?>" />
<input type="hidden" id="title" value="<?php echo "$title"; ?>" />
<input type="hidden" id="date" value="<?php echo "$date3"; ?>" />
<input type="hidden" id="e_mail" value="<?php echo "$email"; ?>" />
	<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
	</html>
<?php
if($query){
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
 
   
xml.open('get','../renew_book_mail.php?date='+date+'&fullName='+fullName+'&title='+title+'&email='+email,true);
xml.send();
 })();
</script>
 ";
}
sleep(3);
header( "refresh:0;url=borrow_directory.php" ); 

?>