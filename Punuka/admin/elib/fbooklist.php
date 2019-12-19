<?php
	session_start();
	include "db_conn.php";
	if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id' AND status='active'");
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
		<style type="text/css">
			.hideAll  {
				visibility:hidden;
			}
		</style>
		<script src="assets/media/js/jquery.js"></script>
		<script src="assets/media/js/jquery.dataTables.min.js"></script>
		
		
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />

		
		
		
		
		<script src="assets/media/js/dataTables.buttons.js"></script>
		<script src="assets/media/ex/buttons.html5.min.js"></script>
		<script src="assets/media/ex/pdfmake.min.js"></script>
		<script src="assets/media/ex/jszip.min.js"></script>
		<script src="assets/media/ex/vfs_fonts.js"></script>
		<script src="assets/media/ex/dataTables.responsive.min.js"></script>
		<script src="assets/media/ex/dataTables.rowReorder.min.js"></script>
		
		
		<link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
		
		<script>
		$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#matter tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#matter').DataTable( {
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
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
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
														


		<!-- Wrapper -->
			<div id="wrapper">
<?php

$resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$location = $rows ['location'];


}


}


?>
				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Books List</strong></a>
								</header>

							<!-- Banner -->



							<!-- Section -->
								

<?php


$query = $mysqli->query ("SELECT * FROM files WHERE view='enabled'");

$foundnum = $query->num_rows; 
 
?>
	<table id="matter" class="display wrap" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Location</th>
			<th>Subject</th>
			<th>Publisher</th>
			<th>Year</th>
			
        </tr>
    </thead>
		<?php 
if($user_name=='Lagos-admin')
{
echo"<tfoot>
            <tr>
            <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Location</th>
			<th>Subject</th>
			<th>Publisher</th>
			<th style='display:none;'>Year</th>
            </tr>
        </tfoot>";
}
?>
    <tbody>
     <?php
	 if($query->num_rows !=0){
	 while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$author=$row["author"];
		$edition=$row["edition"];
		$subject=$row["subject"];
		$location=$row["location"];
		$publisher=$row["publisher"];
		$year=$row["year"];
		
	 ?>
	 <tr>
		<td><?=$title?></td>
		<td><?=$author?></td>
		<td><?=$edition?></td>
		<td><?=$location?></td>
		<td><?=$subject?></td>
		<td><?=$publisher?></td>
		<td><?=$year?></td>
		
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