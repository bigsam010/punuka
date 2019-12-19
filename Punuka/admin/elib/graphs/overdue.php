<?php
include '../db_conn.php';
$currentdate = date('Y-m-d');
$resultset = $mysqli->query("SELECT * FROM borrowers where status=''");
$overdue = $resultset->num_rows;
$staffId = [];
$books = [];

$staffId['name'] = 'Staff ID';
$books['data'] = 'Number of borrowed books';

while ($details = $overdue->num_rows !=0) {
 $staffID['data'][] = $details['staff_id'];
}
var_dump($staffID); exit;