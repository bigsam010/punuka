<?php
include "db_conn.php";
if(isset($_POST['query'])){
	$output = '';
	$query = $mysqli->query ("SELECT full_name FROM users where location='".$_POST['location']."' AND full_name LIKE '%".$_POST["query"]."%'");
	$output = '<ul class="list-unstyled">';
	if($query->num_rows>0){
		 while($row= $query->fetch_assoc()){
			 $output .= '<li>'.$row['full_name'].'</li>';
		 }
	}else{
		$output .= '<li>Name Not Found</li>';
	}
	$output .= '</ul>';
	echo $output;
}



?>