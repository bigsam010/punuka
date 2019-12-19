<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<script src="assets/js/jquery.min.js"></script>
		<script>
				$(document).ready(function(){
						$('#overdue').DataTable();
						});
   		</script>
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
	<script type="text/javascript">
	$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
<?php
sleep(2);
include "db_conn.php";
$accessNum = $_GET["accessNum"];
$location = $_GET["location"];

 $query1 = $mysqli->query ("update entry set status2 = 'available' where accessNum = '$accessNum' AND location='$location'");
$query = $mysqli->query ("DELETE FROM borrow_request WHERE accessNum='$accessNum' AND location='$location'");
header("Location: requests.php");

?>