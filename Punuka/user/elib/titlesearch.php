<?php
include "db_conn.php";
if(isset($_POST['query'])){
	$output = '';
	$query = $mysqli->query ("SELECT title FROM entry where location='".$_POST['location']."' AND (accessNum = '".$_POST["query"]."' AND status2='available')");
	if($query->num_rows>0){
		 while($row= $query->fetch_assoc()){
			 $output .= $row['title'];
		 }
	}else{
		$output .= 'Title Not Found';
	}
	echo $output;
}



?>