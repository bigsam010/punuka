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
sleep(5);

include "db_conn.php";
$title = $_POST["title"];
$author = $_POST["author"];
$location = $_POST["location"];
$position = $_POST["position"];
$edition = $_POST["edition"];
$accessNum = $_POST["accessNum"];
$subject = $_POST["subject"];
$publisher = $_POST["publisher"];
$year = $_POST["year"];

$query = $mysqli->query ("INSERT INTO entry (title,author,location,position,edition,accessNum,subject,publisher,year,status2,view,date) values ('$title','$author',
'$location','$position','$edition','$accessNum','$subject','$publisher','$year','available','enabled',NOW())");
header('Location: manual.php'); 
?>


