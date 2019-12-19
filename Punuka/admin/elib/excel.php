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
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<script src="dist/sweetalert.min.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/soop.js"></script>
	</head>
	<body>
														



		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Upload Book</strong> </a>
										

								</header>

							<!-- Banner -->


							<!-- Section -->
								<section>

<a href="download.php?download_file=entry.csv"><button class="ho"><img src="images/excel.png" class="mam"></button></a> <br /><label class="caut" style="color:red;width:100%;"><b>Note: </b> After Edit, delete the first row(title row) before uploading</label>												
<form action="excel.php" method="post" enctype="multipart/form-data" name="import">
<table align="center" class="tabsub">
<tr>
<td><input type="file" name="csv" /></td>
<td><input type="submit" class="button special" name="submit" value="IMPORT" /></td>
</tr>
<tr><td colspan="2"><span class="style1">make sure to have saved your excel file into a <b>".csv"</b> format</span></td>
</tr>

</table>
</form>
<?php


	if(isset($_POST["submit"]))
	{
		$csv = array();

// check there are no errors
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $ext =  pathinfo($name, PATHINFO_EXTENSION);
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv
    if($ext === 'csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            // necessary if a large csv file
            set_time_limit(0);

            $row = 0;

            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // number of fields in the csv
                $col_count = count($data);

                // get the values from the csv
                $csv[$row]['image_name'] = $data[0];
                $csv[$row]['image_name2'] = $data[1];
				$csv[$row]['author'] = $data[2];
				$csv[$row]['author2'] = $data[3];
				$csv[$row]['author3'] = $data[4];
				$csv[$row]['author4'] = $data[5];
				$csv[$row]['title'] = $data[6];
				$csv[$row]['subject'] = $data[7];
				$csv[$row]['edition'] = $data[8];
				$csv[$row]['vol'] = $data[9];
				$csv[$row]['issue'] = $data[10];
				$csv[$row]['publisher'] = $data[11];
				$csv[$row]['year'] = $data[12];
				$csv[$row]['isbn'] = $data[13];
				$csv[$row]['accessNum'] = $data[14];
				$csv[$row]['issn'] = $data[15];
				$csv[$row]['ref'] = $data[16];
				$csv[$row]['position'] = $data[17];
				$csv[$row]['status2'] = $data[18];
				$csv[$row]['view'] = $data[19];
				$csv[$row]['date'] = $data[20];
				$csv[$row]['toc'] = $data[21];
				$csv[$row]['location'] = $data[22];
				
				$image_name=$csv[$row]['image_name'];
                $image_name2=$csv[$row]['image_name2'];
				$author=$csv[$row]['author'];
				$author2=$csv[$row]['author2'];
				$author3=$csv[$row]['author3']; 
				$author4=$csv[$row]['author4'];
				$title=$csv[$row]['title'];
				$subject=$csv[$row]['subject'];
				$edition=$csv[$row]['edition'];
				$vol=$csv[$row]['vol'];
				$issue=$csv[$row]['issue'];
				$publisher=$csv[$row]['publisher'];
				$year=$csv[$row]['year'];
				$isbn=$csv[$row]['isbn'];
				$accessNum=$csv[$row]['accessNum'];
				$issn=$csv[$row]['issn'];
				$ref=$csv[$row]['ref'];
				$position=$csv[$row]['position'];
				$status2=$csv[$row]['status2'];
				$view=$csv[$row]['view'];
				$date=$csv[$row]['date'];
				$toc=$csv[$row]['toc'];
				$location=$csv[$row]['location'];
				
				
			 	  // inc the row
                $row++;
				
				
				
				$sql = $mysqli->query("INSERT INTO entry (image_name, image_name2, author, author2, author3, author4, title, subject, edition, vol, issue,  publisher, year, isbn, accessNum, issn, ref, position, location, status2, view, date,toc) 
				VALUES ('$image_name','$image_name2','$author','$author2','$author3','$author4','$title','$subject','$edition','$vol','$issue','$publisher','$year','$isbn','$accessNum','$issn','$ref','$position', '$location', 'available','enabled',NOW(),'$toc')");

				
				

               
            }
						if($sql){
				echo "<script>swal({
  title: 'Success alert!',
  text: 'Your database imported successfully.',
  type: 'success',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='excel.php';
},3000);
</script>";
				
			}else{
				echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! Database did not import.',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='excel.php';
},3000);
</script>";
				
			}  
            fclose($handle);
        }else{
			echo "<script>swal({
  title: 'Error alert!',
  text: 'csv file can\'t be opened',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='excel.php';
},3000);
</script>";
			
		}
    }else{
		echo "<script>swal({
  title: 'Error alert!',
  text: 'The file you tried to upload is not a csv file',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='excel.php';
},3000);
</script>";
		
	}
}else{
	echo "<script>swal({
  title: 'Error alert!',
  text: 'You didn\'t select any file.',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='excel.php';
},3000);
</script>";
	
}
	}
	



?>





						</section>

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
		

			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			

	</body>
</html>