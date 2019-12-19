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
					{"targets": [5], "orderable": false, "visible": true, "searchable": false, className: "hide"},
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: 1 },
					{ responsivePriority: 1, targets: 6 },
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
while ($rows = $resultset->fetch_assoc()){
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
									<a href="#" class="logo"><strong>Borrowers Requests</strong></a>
								</header>

							<!-- Banner -->



							<!-- Section -->
<?php
if($user_name=='General-admin'){
$getquery = $mysqli->query("SELECT * FROM borrow_request WHERE request = ''");
}else{
$getquery = $mysqli->query("SELECT * FROM borrow_request WHERE request = '' AND location='$location'");

}
?>
<table id="mata" class="display wrap" cellspacing="0" width="100%">  
<thead>   
	<tr>
		<th>Title</th>
		<th>Borrower Name</th>
		<th>Accession No</th>
		<th>Request Date</th>
		<th>Due Date</th>
		<th style="display:none;">Location</th>
		<th>Accept Request</th>
		<th>Delete Request</th>
		


	</tr>
</thead>
<?php 
if($user_name=='General-admin')
{
echo"<tfoot>
        <th>Title</th>
		<th>Borrower Name</th>
		<th>Accession No</th>
		<th>Request Date</th>
		<th>Due Date</th>
		<th style='display:none;'>Location</th>
		<th>Accept Request</th>
		<th>Delete Request</th>
			
            </tr>
        </tfoot>";
}
?>	
<tbody>
<?php
if ($getquery->num_rows !=0){

while($runrows = $getquery->fetch_assoc())
{
$title = $runrows ['title'];
$full_name = $runrows ['full_name'];
$date =$runrows ['date'];
$due_date = $runrows ['due_date'];
$accessNum=$runrows["accessNum"];
?>

   
<tr>
	<td><p class="title"><?=$title?></p></td>
    <td><p class="fname"><?=$full_name?></p></td>
	<td class="numb"><?=$accessNum?></td>
    <td class="date"><?=$date?></td>
    <td class="due_date"><?=$due_date?></td>
	<td style='display:none;' class="locate"><?=$location?></td>
	<td><button class="btn accept" title="Return Book"><img src="images/tick.png" class="mager"></button></td>
	<td><button class="btn dele" title="Return Book"><img src="images/delete.png" class="mager"></button></td>


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
			<script>
				$(document).ready(function(){
	$(".accept").click(function(){
		var accessNum = $(this).closest("tr").find(".numb").text();
		var full_name = $(this).closest("tr").find(".fname").text();
		var date = $(this).closest("tr").find(".date").text();
		var due_date = $(this).closest("tr").find(".due_date").text();
		var con = swal({
  title: "Confirm Request?",
  text: "This borrow request would be confirmed!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, Confirm!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Confirmed!", "Request has been confirmed", "success");
		window.location="accept_requests.php?accessNum="+accessNum+'&full_name='+full_name+'&date='+date+'&due_date='+due_date;
  } else {
    swal("Cancelled", "Request not confirmed", "error");
  }
});
});
});


$(document).ready(function(){
	$(".dele").click(function(){
		var accessNum = $(this).closest("tr").find(".numb").text();
		var location = $(this).closest("tr").find(".locate").text();
	var con = swal({
  title: "Are you sure?",
  text: "This request will be deleted!",
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
    swal("Deleted!", "Request has been deleted.", "success");
		window.location="delete_requests.php?accessNum="+accessNum+'&location='+location;
  } else {
    swal("Cancelled", "Request not deleted", "error");
  }
});

		
	
	
		
	});	
});
			</script>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
</html>