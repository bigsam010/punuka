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
		
		
		<link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
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
        dom: 'lBfrtip',
		 "columns": [
                {"data": "title"},
                {"data": "author"},
                {"data": "edition"},
                {"data": "status2"},
                {"data": "position"},
				<?php
					if($user_name=='General-admin'){
						echo"{'data': 'location'},";
					}
				?>
                {"data": "accessNum"}
            ],
            "processing": true,
            "serverSide": true,
					"fnRender": function( nRow, data, iDisplayIndex ) {
            $('td:eq(2)', nRow).html('<a href="view.php?comic=' + data[2] + '">' +
                data[0] + '</a>');
            return nRow;
        },
			<?php
				if($user_name=='Lagos-admin'){
					echo"\"ajax\": {
                url: 'search_demo.php',
                type: 'POST',
		
            },";
				}elseif($user_name=='Abuja-admin'){
					echo"\"ajax\": {
                url: 'search_demo2.php',
                type: 'POST'
            },";
				}elseif($user_name=='PortHarcourt-admin'){
					echo"\"ajax\": {
                url: 'search_demo3.php',
                type: 'POST'
            },";
				}else{
					echo"\"ajax\": {
                url: 'search_demo4.php',
                type: 'POST'
            },";
				}
			?>
            
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
		
	
	</head>
	<body class="hideAll">
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

/* if($user_name=='Lagos-admin'){
	$query = $mysqli->query ("SELECT * FROM entry WHERE view='enabled'");
	$foundnum = $query->num_rows; 
}else{
$query = $mysqli->query ("SELECT * FROM entry WHERE view='enabled' AND location='$location'");
$foundnum = $query->num_rows; 
} */
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
    $(window).load(function () {
        $('body').removeClass("hideAll");
    });
</script>


	</body>
</html>