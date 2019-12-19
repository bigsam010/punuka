<?php
	session_start();
	include "db_conn.php";
	
	if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id'");
	if($ad->num_rows == 1){
		while($row = $ad->fetch_assoc()){
			$user_name= $row['user_name'];
			$_SESSION["admin"]=$user_name;
		}
	}

	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<script src="assets/media/js/jquery.js"></script>
		<script src="assets/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/dashboard.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src="assets/media/js/dataTables.buttons.js"></script>
		<script src="assets/media/ex/buttons.html5.min.js"></script>
		<script src="assets/media/ex/pdfmake.min.js"></script>
		<script src="assets/media/ex/jszip.min.js"></script>
		<script src="assets/media/ex/vfs_fonts.js"></script>
		<script src="assets/media/ex/dataTables.responsive.min.js"></script>
		<script src="assets/media/ex/dataTables.rowReorder.min.js"></script>
		
		<script src="dist/sweetalert.min.js"></script>
		<script src="assets/js/javascript.js"></script>
		
		<link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		
		<script>
		$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#mata tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#mata').DataTable( {
		rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                 columns:':visible'
                }
            },
			{
					extend: 'csvHtml5',
					exportOptions: {
						columns: ':visible'
					}
			},
            {
					extend: 'pdfHtml5',
					exportOptions: {
						columns: ':visible'
					}
			},
        ]
    } );
 
    // Apply the search
 /*    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } ); */
} );
				
		</script>
	<script src="assets/js/soop.js"></script>
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
$resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");
if ($resultset->num_rows !=0){
	while ($rows = $resultset->fetch_assoc())
	{
		$location = $rows ['location'];
	}
}
if($user_name=='General-admin'){
$query = $mysqli->query("SELECT view FROM entry WHERE view='enabled' ");
$query1 = $mysqli->query("SELECT DISTINCT staff_id FROM users");
$query2 = $mysqli->query("SELECT staff_id FROM BORROWERS  WHERE status=''");
$query3 = $mysqli->query("SELECT DISTINCT staff_id FROM BORROWERS WHERE due_date <=('$currentdate') AND status=''");
$query4 = $mysqli->query("SELECT * FROM borrow_request WHERE request = ''");
$query5 = $mysqli->query("SELECT * FROM suggest where purchased=''");
$stock = $query->num_rows;
$users = $query1->num_rows;
$borrowers = $query2->num_rows;
$overdue = $query3->num_rows;
$requests = $query4->num_rows;
$suggest = $query5->num_rows;
}else{

$query = $mysqli->query("SELECT view FROM entry WHERE location='$location' AND view='enabled' ");
$query1 = $mysqli->query("SELECT DISTINCT staff_id FROM users WHERE location='$location'");
$query2 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE location = '$location'  AND status=''");
$query3 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE due_date <=('$currentdate') AND (status='' AND location = '$location')");
$query4 = $mysqli->query("SELECT * FROM borrow_request WHERE request = '' AND location='$location'");
$query5 = $mysqli->query("SELECT * FROM suggest where purchased='' AND location='$location'");
$stock = $query->num_rows;
$users = $query1->num_rows;
$borrowers = $query2->num_rows;
$overdue = $query3->num_rows;
$requests = $query4->num_rows;
$suggest = $query5->num_rows;
}
?>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
							<header id="header">
								<a href="#" class="logo"><strong>Welcome</strong></a>
								<ul class="icons">
								<li><strong>Today:</strong><?=$currentdate?>
								</ul>
`							</header>
							<!-- Banner -->
							<section id="banner">
<div class="content">
<header>
<div class="dashboard">

<a href="search.php"><div class="board">Total Books     <span align="right" class="fa fa-book fa-2x"></span><br><h2 align="right"><?=$stock?></h2></a></div>
<a href="edit_user.php"><div class="board borrowers">Library Users    <span class="fa fa-user fa-2x"></span><h2 align="right"><?=$users?></h2></a></div>
<a href="suggest_book.php"><div class="board suggest"> Suggestions <span class="fa fa-lightbulb-o fa-2x"></span><h2 align="right"><?=$suggest?></h2></a></div>
<a href="requests.php"><div class="board req">Borrow Requests   <span class="fa fa-hand-paper-o fa-2x"></span><h2 align="right"><?=$requests?></h2></a></div>
<a href="borrow_directory.php"><div class="board stock">Borrowed Books <span class="fa fa-exchange fa-2x"></span><h2 align="right"><?=$borrowers?></h2></a></div>
<a href="overdue_books.php"><div class="board overdue"> Overdue Books <span class="fa fa-bullhorn fa-2x"></span><h2 align="right"><?=$overdue?></h2></a></div>


</div>
</header>
</div>
</section>
<center><h2>My Library History</h2></center>

							<!-- Section -->
<?php
$getquery = $mysqli->query("SELECT * FROM borrowers where staff_id = '$staff_id' ORDER BY borrowers_id DESC");
?>
<table id="mata" class="display wrap" cellspacing="0" width="100%">  
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
if ($getquery->num_rows !=0){

while($runrows = $getquery->fetch_assoc())
{
$title = $runrows ['title'];
$date =$runrows ['date'];
$due_date = $runrows ['due_date'];
$status = $runrows['status'];
		if($status==""){
	$status="Not Returned yet";
}
$rdate = $runrows ['returned_date'];
if($rdate == "0000-00-00"){
	$rdate="Not Returned yet";
}
?>

   
<tr>
	<td><p class="title"><?=$title?></p></td>
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

			<script src="assets/js/main.js"></script>
			<script src="dist/sweetalert.min.js"></script>
			<script src="assets/js/javascript.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
				<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>