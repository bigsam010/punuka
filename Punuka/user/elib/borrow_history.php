<?php
session_start();
include 'header.php';
include "db_conn.php";
$e_mail=$_SESSION['user'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="media/js/jquery.js"></script>
		<script src="media/js/jquery.dataTables.min.js"></script>
		<script src="assets/mix/dataTables.responsive.min.js"></script>
		<script src="assets/mix/dataTables.rowReorder.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/rowReorder.dataTables.min.css">
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>
		<script>
				$(document).ready(function(){
						$('#borrow').DataTable({
						rowReorder: {
							selector: 'td:nth-child(2)'
						},
						responsive: true,
						});
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
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
					<div id="main">
						<div class="inner">
							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>My Borrow History</strong></a>
								</header>
							<!-- Banner -->
<?php
$query = $mysqli->query ("SELECT * FROM borrowers where e_mail = '$e_mail'");
if ($query->num_rows !=0) {
	?>
	<table id="borrow" class="display" cellspacing="0" width="100%">		
	<thead>
			<tr>
				<th>Book Title</th>
				<th>Due date</th>
				<th>Date borrowed</th>
				<th>Status</th>
			</tr>
		</thead>		
		<tbody>
	<?php
	while($rows= $query->fetch_assoc()){
		$title = $rows['title'];
		$date = $rows['date'];
		$due_date = $rows['due_date'];
		$status = $rows['status'];
?>	<tr>
		<td><?=$title?></td>
		<td><?=$due_date?></td>
		<td><?=$date?></td>
		<td><?=$status?></td>
	</tr>
	<?php 
}
?>
</tbody>	
</table>
<?php
}
else{
	echo "<center><h2>You've not borrowed any book(s).</center>";
}
?>
						</section>
						</div>
					</div>
				<!-- Sidebar -->
							<!-- Menu -->
<?php include 'menu2.php';?>	


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