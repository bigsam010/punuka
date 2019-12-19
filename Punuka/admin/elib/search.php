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

	$currentdate=date('Y-m-d');

$resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$location = $rows ['location'];


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
		<script src="assets/js/boot/js/bootstrap.min.js"></script>
		
		
		<script>

		</script>
		
		
		<link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
	
		
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


?>						


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

 if($user_name=='General-admin'){
	$query = $mysqli->query ("SELECT title, author, edition, status2, position, accessNum, location FROM entry WHERE view='enabled' AND location != ''");
	$foundnum = $query->num_rows; 
}else{
$query = $mysqli->query ("SELECT title, author, edition, status2, position, accessNum, location FROM entry WHERE view='enabled' AND location='$location'");
$foundnum = $query->num_rows; 
} 
?>
	<table id="matter" class="display wrap" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Status</th>
			<th>Position</th>
			<?php
				if($user_name=='General-admin'){
						echo"<th>Location</th>";
					}
			?>
			
			<th>Accession No</th>
			
        </tr>
    </thead>
	<?php 
if($user_name=='General-admin')
{
echo"<tfoot>
            <tr>
            <th>Title</th>
			<th>Main Author</th>
			<th>Edition</th>
			<th>Status</th>
			<th>Location</th>
			<th>Accession No</th>
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
		$status2=$row["status2"];
		$position=$row["position"];
		$loca=$row["location"];
		$accessNum=$row["accessNum"];
		
		 if($user_name=='General-admin'){
		$query1 = $mysqli->query("SELECT full_name FROM borrowers WHERE title = '$title' AND status = ''");
		 }else{
			$query1 = $mysqli->query("SELECT full_name FROM borrowers WHERE title = '$title' AND (location = '$loca' AND status = '')"); 
		 }
		
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
		<td title="<?php if($status2 == 'borrowed'){echo"Borrowed by: ".$full_namee;}?>"><?=$status2?></td>
		<td><?=$position?></td>
		<?php
				if($user_name=='General-admin'){
						echo"<th>".$loca."</th>";
					}
			?>
		<td><?=$accessNum?></td>
		
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
    /* $(window).load(function () {
        $('body').removeClass("hideAll");
    }); */
	
</script> 
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
});

</script>



	</body>
</html>