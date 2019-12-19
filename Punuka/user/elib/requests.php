<?php
session_start();
include 'header.php';
include "db_conn.php";
$location = $_SESSION['location'];
$e_mail = $_SESSION['user'];
$query4 = $mysqli->query("SELECT staff_id FROM users WHERE e_mail = '$e_mail' AND location = '$location'");
		if($query4->num_rows > 0){
			 while($roww = $query4->fetch_assoc()){
				 $staff_id = $roww['staff_id'];
			 }
		}
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
		<link rel="stylesheet" href="assets/dist/sweetalert.css" />
		<script src="assets/dist/sweetalert.min.js"></script>
		<script src="assets/js/soop.js"></script>
		<script>
				$(document).ready(function(){
					    $('#title tfoot th').each( function () {
        					var title = $(this).text();
       					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
   						 } );
						$('#title').DataTable({
							rowReorder: {
								selector: 'td:nth-child(2)'
							},
							responsive: true,
							columnDefs: [
					{"targets": [-1], "orderable": false, "visible": true, "searchable": false, className: "hide"},
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: 4 },
		]
						});
						});
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
	<style>
		.hide {
			display: none!important;
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
$query = $mysqli->query ("SELECT * FROM borrow_request WHERE staff_id='$staff_id' and (request = '' AND location='$location')");
$foundnum = $query->num_rows; 

?>
		<table id="title" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Title</th>
			<th>Accession No</th>
			<th>Request Date</th>
			<th>Due Date</th>
			<th>Delete Request</th>
			<th style="display:none;">Location</th>
        </tr>
    </thead>
    <tbody>
     <?php
	 while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$accessNum=$row["accessNum"];
		$date=$row["date"];
		$due_date=$row["due_date"];
		$location=$row["location"];
		
	 ?>
	 <tr>
		<td><?=$title?></td>
		<td class="numb"><?=$accessNum?></td>
		<td><?=$date?></td>
		<td><?=$due_date?></td>
		<td><button class="btn dell" title="Delete user"><img src="images/delete.png" class="mager"></button></td>
		<td style="display:none;" class="loca"><?=$location?></td>
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
		
			<script>
				$(document).ready(function(){
	$(".dell").click(function(){
		var accessNum = $(this).closest("tr").find(".numb").text();
		var location = $(this).closest("tr").find(".loca").text();
		var con = swal({
  title: "Are you sure?",
  text: "You will not be able to reverse this action!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Deleted!", "Request has been removed", "success");
		window.location="delete_requests.php?accessNum="+accessNum+'&location='+location;
  } else {
    swal("Cancelled", "Request not deleted", "error");
  }
});
});
});
			</script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>