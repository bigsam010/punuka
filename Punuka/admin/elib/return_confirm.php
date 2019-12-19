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
	script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
	</html>
<?php
	session_start();
	include "db_conn.php";
$id = $_GET["id"];
$email = $_GET["email"];
$fname = $_GET["fname"];
$title = $_GET["title"];

echo "<input type=\"hidden\" id=\"e_mail\" value=\"$email\" />";
echo "<input type=\"hidden\" id=\"f_name\" value=\"$fname\" />";
echo "<input type=\"hidden\" id=\"title\" value=\"$title\" />";


echo"<script>
 (function(){
	 var fname = encodeURI(document.getElementById('f_name').value);
	 var email = encodeURI(document.getElementById('e_mail').value);
	 var title = encodeURI(document.getElementById('title').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('post','../return_book_mail.php?fname='+fname+'&email='+email+'&title='+title,true);
xml.send();
 })();
</script>
 ";


 $query = $mysqli->query ("UPDATE entry SET status2='available' where id='$id'");

$query = $mysqli->query ("UPDATE borrowers SET status='returned',returned_date=NOW() WHERE id='$id'");

sleep(2);
 header( "refresh:0;borrow_directory.php" );







