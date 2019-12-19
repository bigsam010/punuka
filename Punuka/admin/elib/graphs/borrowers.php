<?php
include '../db_conn.php';
header("content-type: application/json"); 
$borrowed['name'] = 'Borrow Frequency';
$staffId['name'] = 'Staff ID';
$query = $mysqli->query("SELECT distinct staff_id FROM BORROWERS");
	while ($rows = $query->fetch_assoc()) {
		$staff= $rows['staff_id'];
		$staffId['data'][] = $staff;
		$query2 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE staff_id = '$staff'");
		$borrowed['data'][] = $query2->num_rows;
	}
$result = [];
array_push($result, $staffId);
print json_encode($result);
$query1 = $mysqli->query("SELECT distinct staff_id FROM BORROWERS");
while ($rows2 = $query1->fetch_assoc()) {
$staff= $rows2['staff_id'];
$query2 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE staff_id = '$staff'");
$borrowed['data'][] = $query2->num_rows;
echo $borrowed['data'];
}
