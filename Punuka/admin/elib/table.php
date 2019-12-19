<!DOCTYPE hmtl>
<?php
	session_start();
	include "db_conn.php";
	
	$user_name=$_SESSION["admin"];

	

	?>
<html>
<head>
		 
		<script src="assets/media/js/jquery.js"></script>
		<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
		<script>
			$(document).ready(function(){
				$('#example').DataTable();
			});
		</script>
		
</head>
<body>
<?php
$query = $mysqli->query ("SELECT * FROM entry WHERE view='enabled'");
$foundnum = $query->num_rows;  
?>
	<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <?php
	while($row = $query->fetch_assoc()){
		$title=$row["title"];
		$author=$row["author"];
		$edition=$row["edition"];
		$status2=$row["status2"];
		$location=$row["location"];
		$accessNum=$row["accessNum"];
		echo "<tbody>";

				
echo "
					<tr>
						<td>$title</td>
						<td>$author</td>
						<td>$edition</td>
						<td>$status2</td>
						<td>location</td>
						<td>$accessNum</td>
					</tr>
		
		</tbody>
	";
}
?>
  
</table>








	
	<script>
				$(document).ready(function(){
					$('#search').DataTable();
				});
			</script>
</body>
</html>