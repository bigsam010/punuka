<?php
include "db_conn.php";
if(isset($_POST['note'])){
	$output = '';
	$location = $_POST['location'];
	$title = $_POST["note"];
	$query = $mysqli->query ("SELECT accessNum FROM entry where location='$location' AND title= '$title'");
	if($query->num_rows>0){
		 while($row= $query->fetch_assoc()){
			 $output = $row['accessNum'];
		 }
	}else{
		$output = "AccessNumber Not Found";
	}
	echo $output;
}



?>