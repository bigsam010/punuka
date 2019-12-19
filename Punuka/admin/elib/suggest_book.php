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
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<style type="text/css">
			.hideAll  {
				visibility:hidden;
			}
		</style>
		
		
		
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		

		
		
		
		
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
		<link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
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
		columnDefs: [
					{"targets": [1], "orderable": false, "visible": true, "searchable": false, className: "hide"},
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: 3 },
					{ responsivePriority: 1, targets: -1 },
		],
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
	<style>
		.hide {
			display: none!important;
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


?>													


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Books Suggested</strong> </a>
								</header>

							<!-- Banner -->
<?php

$currentdate=date('Y-m-d');

if($user_name=='General-admin'){
$resultset = $mysqli->query("SELECT * FROM suggest where purchased='' order by suggest_date asc");
}else{
	$resultset = $mysqli->query("SELECT * FROM suggest where purchased='' AND location='$location' order by suggest_date asc");
}

?>
<table id="mata" class="display wrap" cellspacing="0" width="100%">   
<thead>  
	<tr>
		
		<th>Book Title</th>
		<th style="display:none;">Id</th>
		<th>Book Author</th>
		<th>Suggested By</th>
		<th>Date Suggested</th>
		<th>Location</th>
		<th>Purchased</th>


	</tr>
</thead>
<?php 
if($user_name=='General-admin')
{
echo"<tfoot>
            <tr>
            
			<th>Book Title</th>
			<th style='display:none;'>Id</th>
			<th>Book Author</th>
			<th>Suggested By</th>
			<th>Date Suggested</th>
			<th>Location</th>
			<th style='display:none;'>Purchased</th>
            </tr>
        </tfoot>";
}
?>	
<tbody>
<?php
$foundnum = $resultset->num_rows;
if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{
$id = $rows ['suggest_id'];
$full_name = $rows ['full_name'];
$suggest_date = $rows ['suggest_date'];
$suggest_title = $rows ['suggest_title'];
$suggest_author = $rows ['suggest_author'];
$suggest_date = $rows ['suggest_date'];
$location = $rows ['location'];

?>
 <tr>
	<td><?=$suggest_title?></td>
	<td style="display:none;"><p class="id"><?=$id?></p></td>
 	<td><?=$suggest_author?></td>
	<td><?=$full_name?></td>
	<td><?=$suggest_date?></td>
	<td><?=$location?></td>
	<td><button class="btn sug" title="Purchased"><img src="images/p.png" class="mager"></button></td>

</tr>
 <?php
}
}else{
	echo"<b>No suggested books for now<b>";
}
 
 ?>
 </tbody>
</table>






							<!-- Section -->
							





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