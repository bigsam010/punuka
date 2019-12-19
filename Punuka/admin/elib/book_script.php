<?php

include "db_conn.php";

$query = $mysqli->query("UPDATE entry SET location ='Lagos'");
$query1 = $mysqli->query("UPDATE users SET location ='Lagos'");


if($query){
  var_dump("suceesful");
}
else{
  var_dump($mysqli->error); exit();
}
?>
