<?php
session_start();
include 'header.php';
include "db_conn.php";
$location = $_SESSION['location'];
$e_mail = $_SESSION['user'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<style type="text/css">.hideAll{visibility: hidden;}</style>
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<script src="media/js/jquery.js"></script>
		<script src="media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>
		<script>
				$(document).ready(function(){
						$('#title').DataTable();
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
<?php
$currentdate=date('Y-m-d');

?>						


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Search By Location</strong></a>
								</header>

							<!-- Banner -->



							<!-- Section -->
<center>								
<form method="post" action="" style="margin-top:20px;">
<div class="dform">
<label class="pom hhh"><b>Select a Location:</b></label>
<select name="new_pos" class="pop" required>
	<option></option>
	<option>Abuja</option>
	<option>Lagos</option>
	<option>Asaba</option>
</select>
<button name="submit" style="background:#5A0524;box-shadow:inset 0 0 0 2px #5A0524; height:auto;">Choose</button>
</div>
</form>
</center>
<?php
if(isset($_POST['submit'])){
	$new_pos=$_POST['new_pos'];
	echo"<script>setTimeout(function(){
	window.location.href='search_by_location.php?pos=$new_pos';
},0);
</script>";
}
if(!empty($_GET['pos'])){
$pos = $_GET['pos'];
$query = $mysqli->query ("SELECT * FROM entry WHERE view='enabled' AND location='$pos'");
$foundnum = $query->num_rows; 

?>
	<table id="title" class="display wrap" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Status</th>
			<th>Location</th>
			<th>Accession No</th>
			
        </tr>
    </thead>		
    <tbody>
     <?php
	 if($query->num_rows !=0){
	 while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$author=$row["author"];
		$edition=$row["edition"];
		$status2=$row["status2"];
		$location=$row["location"];
		$accessNum=$row["accessNum"];
		
	 ?>
	 <tr>
		<td><?=$title?></td>
		<td><?=$author?></td>
		<td><?=$edition?></td>
		<td><?=$status2?></td>
		<td><?=$location?></td>
		<td><?=$accessNum?></td>
		
	 </tr>
	 <?php
	 }
	 }
}

	 ?>
	</tbody>


</table>
						

						</div>
					</div>

				<!-- Sidebar -->

							<!-- Menu -->
<?php 
	require 'menu2.php';
	
?>	


							<!-- Section -->

							<!-- Footer -->

			</div>

		<!-- Scripts -->
				


			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>


	</body>
</html>