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
		<script src="assets/mix/dataTables.responsive.min.js"></script>
		<script src="assets/mix/dataTables.rowReorder.min.js"></script>
		
		
		<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/rowReorder.dataTables.min.css">
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/soop.js"></script>
		<script>
				$(document).ready(function(){
					   
						$('#title').DataTable({
							rowReorder: {
								selector: 'td:nth-child(2)'
							},
							responsive: true,
							columnDefs: [
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: -1 },
		],
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
									<a href="#" class="logo"><strong>Search</strong></a>
								</header>
							<!-- Banner -->
							<!-- Section -->
<?php
$query = $mysqli->query ("SELECT * FROM entry WHERE view='enabled' and location = '$location'");
$foundnum = $query->num_rows; 

?>
		<table id="title" class="display" cellspacing="0" width="100%">
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
	 while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$author=$row["author"];
		$edition=$row["edition"];
		$status2=$row["status2"];
		$position=$row["position"];
		$loca=$row["location"];
		$accessNum=$row["accessNum"];
		
		$query1 = $mysqli->query("SELECT full_name FROM borrowers WHERE title = '$title' AND (location = '$loca' AND status = '')");
		
		
		if($query1->num_rows > 0){
			 while($roww = $query1->fetch_assoc()){
				 $full_namee = $roww['full_name'];
			 }
		}
	 ?>
	 <tr>
		<td><?php if($status2 != 'borrowed'){echo "<a href='borrow_book.php?title=$title&booknum=$accessNum'>";}?><?=$title?></a></td>
		<td><?=$author?></td>
		<td><?=$edition?></td>
		<td title="<?php if($status2 == 'borrowed'){echo "Borrowed by: ".$full_namee;}?>"><?=$status2?></td>
		<td><?=$position?></td>
		<td><?=$accessNum?></td>
	 </tr>
	 <?php
	 }
	 ?>
	</tbody>
</table>
						

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
		<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>