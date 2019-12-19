<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<script src="dist/sweetalert.min.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
<?php
include("db_conn.php");
 $title = $_POST["title"];
 $author = $_POST["author"];
 $edition = $_POST["edition"];
 $location = $_POST["location"];
 $subject = $_POST["subject"];
 $publisher = $_POST["publisher"];
 $year = $_POST["year"];
 
 
 
 
   if(isset($_FILES['image_file'])){
      $errors= array();
      $file_name = $_FILES['image_file']['name'];
	  $file_url = "../../uploads/".$file_name;
      $file_size =$_FILES['image_file']['size'];
      $file_tmp =$_FILES['image_file']['tmp_name'];
      $file_type=$_FILES['image_file']['type'];
      $file_exti=explode('.',$_FILES['image_file']['name']);
	  $file_ext=strtolower(end($file_exti));
      
      $expensions= array("pdf","doc");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF or DOC file.";
		 echo "<script>swal({
  title: 'Error alert!',
  text: 'Sorry! Only PDF and DOC files can be uploaded.',
  type: 'error',
  timer: 3000,
  showConfirmButton: false
});</script>";

header( "refresh:2;url=uploadfile.php" );
      }
      
      if($file_size > 3097152){
         $errors[]='File size must be excately 3 MB';
      }
      
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,$file_url)){
         echo "Success";
		 echo $file_name;
		 echo $file_url;
		 $mysqli->query("INSERT INTO files (title,author,edition,location,subject,publisher,year,file_name,file_url,view) VALUES ('$title','$author','$edition','$location','$subject','$publisher','$year','$file_name','$file_url','enabled')");
		 header("Location:uploadfile.php");
      }else{
         print_r($errors);
      }
   }
   }

/* $target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["image_file"]["name"]);
$file_name= basename($_FILES["image_file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image_file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
		 $query = $mysqli->query ("SELECT * FROM files WHERE url = '$target_file");
 if($query)
 {
 	$num = $query->num_rows;
 	if($num == 1)
 	{
 		echo $target_file;


 	}
 	else
 	{
     $mysqli->query("INSERT INTO files (title,author,edition,location,subject,publisher,year,file_name,file_url,view) 
	 VALUES('$title','$author','$edition','$location','$subject','$publisher','$year','$file_name','$target_file','enabled')");
 	header("Location:uploadfile.php");
 	}
 		
 	
 }
 
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} */

?>
</body>
</html>