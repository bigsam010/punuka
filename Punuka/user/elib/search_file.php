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
							responsive: true
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
$query = $mysqli->query ("SELECT * FROM files WHERE view='enabled'");
$foundnum = $query->num_rows;  
?>
	<table id="title" class="display wrap" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Location</th>
			<th>Publisher</th>
			<th>Year</th>
        </tr>
    </thead>
	<tbody>
     <?php
	 if($query->num_rows !=0){
	 while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$author=$row["author"];
		$edition=$row["edition"];
		$publisher=$row["publisher"];
		$location=$row["location"];
		$year=$row["year"];
		$url=$row["file_url"];
		
	 ?>
	 <tr>
		<td><a href="<?=$url?>" target="_blank"><?=$title?></a></td>
		<td><?=$author?></td>
		<td><?=$edition?></td>
		<td><?=$location?></td>
		<td><?=$publisher?></td>
		<td><?=$year?></td>
		
	 </tr>

<?php
}}
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
			
			<script src="assets/js/javascript.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
		<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>