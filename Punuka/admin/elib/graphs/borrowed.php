<?php
include '../db_conn.php';
header("content-type: application/json"); 
$stock['name'] = 'Total library stock';
$borrowed['name'] = 'Borrowed Books';
$query = $mysqli->query("SELECT * FROM entry");
$query2 = $mysqli->query("SELECT * FROM BORROWERS");
$stock['data'][] = $query->num_rows;
$borrowed['data'][] = $query2->num_rows;
$result = [];
array_push($result, $stock);
array_push($result, $borrowed);
print json_encode($result,JSON_NUMERIC_CHECK);