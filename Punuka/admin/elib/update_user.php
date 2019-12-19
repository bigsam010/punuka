<?php
sleep(3);
include "db_conn.php";
$fname = $_POST["fname"];
$staff_id = $_POST["staff_id"];
$login = $_POST["login"];
$mail = $_POST["mail"];
$id = $_POST["id"];
$admin_priv = $_POST["admin"];
$admin = $_POST["admin_name"];
$location = $_POST["location"];


$query = $mysqli->query ("UPDATE users SET full_name='$fname', location='$location', e_mail='$mail', staff_id='$staff_id', login='$login' where id_staff='$id'");

 
 if($admin_priv != ""){
	 $query1 = $mysqli->query ("SELECT location from users WHERE staff_id='$staff_id'");
	if($query1->num_rows > 0){
	 while($row = $query1->fetch_assoc()){
		 $location = $row['location'];
	 }
	  $query2 = $mysqli->query ("SELECT staff_id,user_name from admin WHERE staff_id='$staff_id'");
	  while($rows = $query2->fetch_assoc()){
		  $ad_username = $rows['user_name'];
	  }
	  if($query2->num_rows == 1 && ($admin_priv == "Deactivate" && $ad_username==$admin)){
		   $query3 = $mysqli->query ("UPDATE admin SET status='deactivated' where staff_id='$staff_id'");
	  }elseif($query2->num_rows == 1 && ($admin_priv == "Activate" && $ad_username==$admin)){
		  $query3 = $mysqli->query ("UPDATE admin SET status='active' where staff_id='$staff_id'");
	  }elseif($query2->num_rows == 1 && (($admin_priv == "Activate" || $admin_priv == "Deactivate" ) && $ad_username!=$admin)){
		  
	  }else{
		  $query = $mysqli->query ("insert into admin (user_name,staff_id,location,status,date) values ('$admin','$staff_id','$location','active',NOW())");
	  }
}

}
header('Location: edit_user.php'); 
exit();
?>