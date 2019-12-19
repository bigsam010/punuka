<?php
sleep(6);

include "db_conn.php";
$title = $_POST["title"];
$id = $_POST["id"];
$author = $_POST["author"];
$position = $_POST["position"];
$accessNum = $_POST["accessNum"];
$subject = $_POST["subject"];
$view = $_POST["view"];
$publisher = $_POST["publisher"];
$year = $_POST["year"];


$query = $mysqli->query ("UPDATE entry SET title='$title', author='$author', position='$position', accessNum='$accessNum',
 subject='$subject', view='$view', publisher='$publisher', year='$year' where id='$id'");
header('Location: view_books2.php');
?>


