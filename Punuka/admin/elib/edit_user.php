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
	}else{
		header("Location: logout.php");
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

		
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<style type="text/css">
			.hideAll  {
				visibility:hidden;
			}
		</style>
		
		
		
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<?php
		 if($user_name=='General-admin'){
			echo "<link rel='stylesheet' href='assets/css/node.css' />";
		 }
		?>
		

		
		
		
		
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
		.mmm{
			margin-top:40px;
		}
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
					{"targets": [5,6,7,8], "orderable": false, "visible": true, "searchable": false, className: "hide"},
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 1, targets: 9 },
					{ responsivePriority: 1, targets: 10 },
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
<input style="display:none" name="admin_name" value="<?=$user_name?>"/>
<p class="pom numb">Full Name:</p>
<input class="oon fname numb" name="fname" required>
<p class="pom numb">Staff ID:</p>
<input class="oon staff_id numb" name="staff_id" id="numb" required>
<p class="pom numb t">Admin Priviledge:</p>
<select class="oon adminn numb" name="admin">
</select>
<p class="pom numb t">Location:</p>
<select class="oon locate numb" name="location">
	<option>Lagos</option>
	<option>Asaba</option>
	<option>Abuja</option>
</select>
<p class="pom numb">Login Priviledge:</p>
<select class="oon login numb" name="login" required>
	<option>Enabled</option>
	<option>Disabled</option>
</select>
<p class="pom numb">Email:</p>
<input class="oon em numb" name="mail" required>
<div class="fox tilty">
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
<div class="fox tilt">
<button class="mo ed">Send</button>
<div class="mo k die">Cancel</div>
</div>
</form>

</div>
</div>


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Edit Users</strong> </a>
																				<ul class="icons">
										<li><a href="index.php"><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->


							<!-- Section -->
								


																
<?php
$currentdate=date('Y-m-d');
if($user_name=='General-admin'){
	$resultset = $mysqli->query("select * from users order by full_name asc");
}else{
	$resultset = $mysqli->query("select * from users WHERE location='$location' order by full_name asc");
}
?>
<table id="mata" class="display wrap" cellspacing="0" width="100%">  
<thead>   
	<tr>
		<th>Name</th>
		<th>Staff ID</th>
		<th>Login Priviledge</th>
		<th>Email</th>
		<th>Location</th>
		<th style="display:none;">Id</th>
		<th style="display:none;">Admin</th>
		<th style="display:none;">GAdmin</th>
		<th style="display:none;">Rank</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Send Mail</th>
		


	</tr>
</thead>
<?php 
if($user_name=='General-admin')
{
echo"<tfoot>
            <tr>
            <th>Name</th>
			<th>Staff ID</th>
			<th>Login Priviledge</th>
			<th>Email</th>
			<th>Location</th>
			<th style='display:none;'>Id</th>
			<th style='display:none;'>Admin</th>
			<th style='display:none;'>GAdmin</th>
			<th style='display:none;'>Rank</th>
			<th style='display:none;'>Edit</th>
			<th style='display:none;'>Delete</th>
			<th style='display:none;'>Send Mail</th>
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
$password = $rows ['password'];
$location = $rows ['location'];


if($user_name != "General-admin"){
$resultsetad = $mysqli->query("select * from admin WHERE staff_id='$staff_idd' AND (status='active' AND user_name='General-admin')");
if($resultsetad->num_rows > 0){
		 $common = "lighted";
}else{
	$common = "darken";
}
}else{
	$common = "";
}

$resultsetadwe = $mysqli->query("select * from admin WHERE staff_id='$staff_idd' AND status='active'");
if($resultsetadwe->num_rows > 0){
	$admin_status = "active";
	$rank="*";
}else{
	$admin_status = "non-active";
	$rank="";
}



?>
<tr>
				<td><p class="name"><?=$full_name?></p></td>
				<td><p class="staff"><?=$staff_idd?></p></td>
				<td><p class="login"><?=$login?></p></td>
				<td><p class="mail"><?=$e_mail?></p></td>
				<td><p class="location"><?=$location?></p></td>
				<td style="display:none;"><p class="id"><?=$id_staff?></p></td>
				<td style="display:none;"><p class="admin"><?=$admin_status?></p></td>
				<td style="display:none;"><p class="admin_user_name"><?=$common?></p></td>
				<td style="display:none;"><p><?=$rank?></p></td>
				<td><button class="btn make" title="Edit user"><img src="images/edit-user.png" class="mager"></button></td>
				<td><button class="btn dell" title="Delete user"><img src="images/delete.png" class="mager"></button></td>
				<td><button class="btn sendit" title="Send mail"><img src="images/mail.png" class="mager"></button></td>

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
</script>
	</body>
</html>