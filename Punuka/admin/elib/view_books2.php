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
		<link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		
		<style>
		.hide {
			display: none!important;
		}
		</style>
		
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
					{"targets": [7,8,9,10,11], "orderable": false, "visible": true, "searchable": false, className: "hide"},
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: 12 },
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
	</head>
	<body>
	<div class="loader"></div>
														
<div class="modal">
<div class="modal_close close"></div>
<div class="modal_main">
<img src="images/i783wQYjrKQ.png" class="close ic">
<form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="update.php" onsubmit="swal({
  title: 'Success!',
  text: 'Data updated successfully.',
  type: 'success',
  timer: 6000,
  showConfirmButton: false
});">
<input class="identity" style="display:none" name="id"/>
<p class="pom numb">Title:</p>
<input class="oon tit numb" name="title" required/>
<p class="pom numb">Author:</p>
<input class="oon aut numb" name="author" required/>
<p class="pom numb">Position:</p>
<input class="oon loc numb" name="position" placeholder="shelf - row -"/>
<p class="pom numb">Accession No:</p>
<input class="oon access numb" name="accessNum"/>
<p class="pom numb">Subject:</p>
<input class="oon sub numb" name="subject"/>
<p class="pom numb">View:</p>
<select class="oon v numb" name="view">
	<option>enabled</option>
	<option>disabled</option>
</select>
<p class="pom numb">Publisher:</p>
<input class="oon pub numb" name="publisher"/>
<p class="pom numb">Year:</p>
<input class="oon y numb" name="year"/>
<div class="fox tilty">
<button class="mo ed">Update</button>
<div class="mo k">Cancel</div>
</div>
</form>

</div>
</div>

		<!-- Wrapper -->
			<div id="wrapper">

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
				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Edit Books</strong></a>
								</header>

							<!-- Banner -->
<?php
include "db_conn.php";
if($user_name=='General-admin'){
$query = $mysqli->query ("SELECT (view) FROM entry where view = 'enabled'");
$rows = $query->num_rows;

$query1 = $mysqli->query ("SELECT title, author, status2, position, location, edition, accessNum, subject, publisher, view, year, id FROM entry where view = 'enabled'");
$rowss = $query1->num_rows;
}else{
	$query = $mysqli->query ("SELECT (view) FROM entry where view = 'enabled' AND location='$location'");
$rows = $query->num_rows;

$query1 = $mysqli->query ("SELECT * FROM entry where view = 'enabled' AND location='$location'");
$rowss = $query1->num_rows;
}






?>


							<!-- Section -->
							






<table id="mata" class="display wrap" cellspacing="0" width="100%"> 
<thead>   
<tr>
    <th>Title</th>
	<th>Main Author</th>
	<th>Edition</th>
	<th>Status</th>
	<th>Position</th>
	<th>Location</th>
	<th>Accession No</th>
	<th style="display:none;">Subject</th>
	<th style="display:none;">Publisher</th>
	<th style="display:none;">View</th>
	<th style="display:none;">Year</th>
	<th style="display:none;">Id</th>
	<th>Edit</th>
	<th>Delete</th>


  </tr>
  </thead>
  <?php 
if($user_name=='General-admin')
{
echo"<tfoot>
    <th>Title</th>
	<th>Main Author</th>
	<th>Edition</th>
	<th>Status</th>
	<th>Position</th>
	<th>Location</th>
	<th>Accession No</th>
	<th style='display:none;'>Subject</th>
	<th style='display:none;'>Publisher</th>
	<th style='display:none;'>View</th>
	<th style='display:none;'>Year</th>
	<th style='display:none;'>Id</th>
	<th>Edit</th>
	<th>Delete</th>
        </tfoot>";
}
?>		
  <tbody>
<?php
if ($query1->num_rows !=0){

while($runrows = $query1->fetch_assoc())
{
$title = $runrows ['title'];
$author = $runrows ['author'];
$status2 = $runrows ['status2'];
$position = $runrows ['position'];
$location = $runrows ['location'];
$edition =$runrows ['edition'];
$accessNum =$runrows ['accessNum'];
$subject =$runrows ['subject'];
$publisher =$runrows ['publisher'];
$view =$runrows ['view'];
$year =$runrows ['year'];
$id =$runrows ['id'];
  
?>
<tr>
		<td><p class="title"><?=$title?></p></td>
		<td><p class="author"><?=$author?></p></td>
		<td><?=$edition?></td>
		<td><?=$status2?></td>
		<td><p class="position"><?=$position?></p></td>
		<td><p><?=$location?></p></td>
		<td><p class="accessno"><?=$accessNum?></p></td>
		
		<td style="display:none;"><p class="subject"><?=$subject?></p></td>
		<td style="display:none;"><p class="publisher"><?=$publisher?></p></td>
		<td style="display:none;"><p class="view"><?=$view?></p></td>
		<td style="display:none;"><p class="year"><?=$year?></p></td>
		<td style="display:none;"><p class="id"><?=$id?></p></td>
		
		<td><button class="btn edit" title="Edit Book"><img src="images/edit.png" class="mage"></button></td>
		<td><button class="btn del" title="Delete Book"><img src="images/delete.png" class="mage"></button></td>
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
			
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
				<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script
			

	</body>
</html>