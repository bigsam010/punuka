<?php
session_start();
include 'header.php';
include '../../db_conn.php';
$e_mail = $_SESSION['user'];
$getUserDetails = $mysqli->query("SELECT * from users where e_mail = '$e_mail'");
if ($result = $getUserDetails->num_rows!=0)
{
$result = mysqli_fetch_assoc($getUserDetails);
	$full_name = $_SESSION['full_name'] = $result['full_name'];
	$profile_pic = $_SESSION['profile_pic'] = $result['profile_pic'];
	$staff_id = $_SESSION['staff_id'] = $result['staff_id'];
	$location = $_SESSION['location'] = $result['location'];
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<script src="assets/js/jquery.min.js"></script>
		<script src="media/js/jquery.dataTables.min.js"></script>
		<script src="assets/mix/dataTables.responsive.min.js"></script>
		<script src="assets/mix/dataTables.rowReorder.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/mix/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="media/css/buttons.dataTables.css">
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/dashboard.css" />
		<script src="assets/js/soop.js"></script>
		<script>
				$(document).ready(function(){
						$('#overdue').DataTable({
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
															
<?php
$currentdate=date('Y-m-d');


$query = $mysqli->query("SELECT view FROM entry WHERE location='$location' AND view='enabled' ");
$query1 = $mysqli->query ("SELECT * FROM borrow_request WHERE staff_id='$staff_id' and (request = '' AND location='$location')");
$query2 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE location = '$location'  AND e_mail='$e_mail'");
$query3 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE (due_date <=('$currentdate') AND staff_id='$staff_id') AND (status='' AND location = '$location')");
$stock = $query->num_rows;
$reqest = $query1->num_rows;
$borrowers = $query2->num_rows;
$overdue = $query3->num_rows;


?>
	<div class="loader"></div>

<?php $currentdate=date('Y-m-d'); ?>
		<!-- Wrapper -->
			<div id="wrapper">		<!-- Main -->
					<div id="main">
						<div class="inner">						<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Welcome</strong> <?php echo "$full_name"; ?></a>
									<ul class="icons">
										 <li><strong>Today:</strong> <?php echo $currentdate; ?>
									</ul>
								</header>				<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
										<div class="dashboard">

<a href="search.php"><div class="board">Total Books     <span align="right" class="fa fa-book fa-2x"></span><br><h2 align="right" style="color:#fff;"><?=$stock?></h2></a></div>
<a href="requests.php"><div class="board req">Requested Books   <span class="fa fa-hand-paper-o fa-2x"></span><h2 align="right" style="color:#fff;"><?=$reqest?></h2></a></div>
<a href="borrow_history.php"><div class="board stock">Borrowed Books <span class="fa fa-exchange fa-2x"></span><h2 align="right" style="color:#fff;"><?=$borrowers?></h2></a></div>
<a href="overdue_books.php"><div class="board overdue"> Overdue Books <span class="fa fa-bullhorn fa-2x"></span><h2 align="right" style="color:#fff;"><?=$overdue?></h2></a></div>

</div>
										</header>
										
										
<?php
$resultset = $mysqli->query("SELECT * FROM borrowers where staff_id = '$staff_id' ORDER BY date DESC");
?>
<center><h2>My Library History</h2></center>
	<table id="overdue" class="display" cellspacing="0" width="100%">		
	<thead>
			<tr>
				<th>Book Title</th>
				<th>Date borrowed</th>
				<th>Due date</th>
				<th>Date Returned</th>
				<th>Status</th>
			</tr>
		</thead>		
		<tbody>
	<?php
	if ($resultset->num_rows !=0){
	while($rows= $resultset->fetch_assoc()){
		$title = $rows['title'];
		$date = $rows['date'];
		$due_date = $rows['due_date'];
		$status = $rows['status'];
		if($status==""){
	$status="Not Returned yet";
}
		$rdate = $rows ['returned_date'];
if($rdate=="0000-00-00"){
	$rdate="Not Returned yet";
}
?>	
<tr>
		<td><?=$title?></td>
		<td><?=$date?></td>
		<td><?=$due_date?></td>
		<td <?php if($rdate=="Not Returned yet"){ echo "style='color:red;'";}?>><?=$rdate?></td>
		<td <?php if($status=="Not Returned yet"){ echo "style='color:red;'";}?>><?=$status?></td>
	</tr>
 <?php
}
}
 
 ?>
</tbody>	
</table>
							</div>
								</section>
						</div>
					</div>
				<!-- Sidebar -->
							<!-- Menu -->
<?php 	include 'menu2.php'; ?>	
							<!-- Section -->
							<!-- Footer -->
			</div>
		<!-- Scripts -->
			
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>