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
														
<?php
$currentdate=date('Y-m-d');



?>
<div class="modal">
<div class="modal_close close"></div>
<div class="modal_main mode">
<img src="images/i783wQYjrKQ.png" class="close ic">
<form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="update_user.php" onsubmit="swal({
  title: 'Success!',
  text: 'User data updated successfully.',
  type: 'success',
  timer: 5000,
  showConfirmButton: false
});">
<input class="id_s" style="display:none" name="id"/>
<p class="pom">Full Name:</p>
<input class="oop fname" name="fname" required>
<p class="pom">Staff ID:</p>
<input class="oop staff_id" name="staff_id" required>
<p class="pom">Login Priviledge:</p>
<select class="oop login" name="login" required>
	<option>Enabled</option>
	<option>Disabled</option>
</select>
<p class="pom">Email:</p>
<input class="oop em" name="mail" required>
<div class="fox">
<button class="mo ed">Update</button>
<div class="mo k">Cancel</div>
</div>
</form>
</div>
</div>

<div class="moda">
<div class="moda_close die"></div>
<div class="modal_mail ex">
<img src="images/i783wQYjrKQ.png" class="die ic">
<form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="sendmail.php" onsubmit="swal({
  title: 'Success!',
  text: 'Mail sent successfully.',
  type: 'success',
  timer: 5000,
  showConfirmButton: false
});">
<input class="r_name" style="display:none" name="r_name"/>
<input class="r_mail" style="display:none" name="r_mail"/>
<p class="pom">Type in the mail you want to send</p>
<input placeholder="Mail title" class="oop" name="m_title" required>
<textarea class="text" placeholder="mail content goes here" name="m_content" required></textarea>
<div class="fox">
<button class="mo ed">Send</button>
<div class="mo k die">Cancel</div>
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
									<a href="#" class="logo"><strong>Users Report</strong> </a>
																				<ul class="icons">
										<li><a href="../../new/elib/index.php?e_mail=<?php echo "$e_mail&staff_id=$staff_id";?> "><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->


							<!-- Section -->
								


																
<?php
$currentdate=date('Y-m-d');
if($user_name=='General-admin'){
$resultset = $mysqli->query("select * from users WHERE login='Enabled' order by full_name asc");
}else{
$resultset = $mysqli->query("select * from users WHERE login='Enabled' AND location='$location' order by full_name asc");
}
?>
<table id="mata" class="display wrap" cellspacing="0" width="100%">  
<thead>   
	<tr>
		<th>Name</th>
		<th>Staff ID</th>
		<th>Email</th>
		<th>Location</th>
		<th>No of Books borrowed</th>
		<th>No of files used</th>
	</tr>
</thead>
<?php 
if($user_name=='General-admin')
{
echo"<tfoot>
            <tr>
            <th>Name</th>
		<th>Staff ID</th>
		<th>Email</th>
		<th>Location</th>
		<th style='display:none;'>No of Books borrowed</th>
		<th style='display:none;'>No of files used</th>
           </tr>
        </tfoot>";
}
?>	
<tbody>
<?php
if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$full_name = $rows['full_name'];
$login = $rows ['login'];
$id_staff = $rows ['id_staff'];
$staff_idd = $rows ['staff_id'];
$e_mail = $rows ['e_mail'];
$location = $rows ['location'];
$password = $rows ['password'];
$file = $rows ['file_use'];

$queryw = $mysqli->query ("SELECT (staff_id) FROM borrowers WHERE staff_id='$staff_id'");
$foundnumw = $queryw->num_rows; 

?>
<tr>
				<td><p class="name"><?=$full_name?></p></td>
				<td><p class="staff"><?=$staff_idd?></p></td>
				<td><p class="mail"><?=$e_mail?></p></td>
				<td><p><?=$location?></p></td>
				<td><p class="login"><?=$foundnumw?></p></td>
				<td><p class="login"><?=$file?></p></td>
				

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