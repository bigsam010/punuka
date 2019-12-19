<?php
	session_start();
	include "db_conn.php";
if (!isset ($_SESSION["staff_id"])){
		header("Location: ../../");
	}else{
	
	$staff_id=$_SESSION["staff_id"];
	}
	
	$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id'");
	if($ad->num_rows == 1){
		while($row = $ad->fetch_assoc()){
			$user_name= $row['user_name'];
			$_SESSION["admin"]=$user_name;
		}
	}

	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
														


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Search through Table of Contents</strong></a>
								</header>

							<!-- Banner -->
<?php

$query = $mysqli->query ("SELECT (view) FROM entry where accessNum is NOT NULL and image_name2='' ");
$rows = $query->num_rows;


echo
"<fieldset><h2 align=center><strong>$rows Book(s) Catalogued with Table of Content </strong></h2></fieldset>";



?>


							<!-- Section -->
								<section>



<form action='search_content.php' method='POST'>
<center>
<input type='text' size='90' name='search' placeholder='search using keywords, terms etc.'>
<input type="hidden" name="e_mail" value="<?php echo "$e_mail" ?>"></br></br>
<input type='submit' name='submit' value='Search' class="button special"></br></br></br>
</center>
</form>

<?php
if(isset($_POST['search']))
{
	$search = $_POST ['search'];
}else
	$search="";
	

  

{
echo "You searched for <b>$search</b> <hr size='1'></br>";
    
$search_exploded = explode (" ", $search);
 
$x = "";
$construct = "";  
    
foreach($search_exploded as $search_each)
{
$x++;
if($x==1)
$construct .="view='enabled' AND title LIKE '%$search_each%'";
else
$construct .="view='enabled' AND title LIKE '%$search_each%'";
    
}

$query = $mysqli->query ("SELECT * FROM entry WHERE $construct ");
$foundnum = $query->num_rows;  
 
   
if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words. ";
else
{ 
  
echo "$foundnum results found !<p>";
  
$per_page = 50;
$start = isset($_GET['start']) ? $_GET['start']: '';
$max_pages = ceil($foundnum / $per_page);
if(!$start)
$start=0; 
$getquery = $mysqli->query("SELECT * FROM entry WHERE $construct  order by title asc LIMIT $start, $per_page");
echo "<table border =0 align = center id class='table-wrapper' >    
<tr>
    <td width = 250 align = center><strong>Title</strong></td>
	<td width = 200 align = center><strong>Main Author</strong></td>
	<td width = 100 align = center><strong>View Book</strong></td>
	<td width = 120 align = center><strong>Status</strong></td>
	<td width = 120 align = center><strong>Location</strong></td>
	<td width = 120 align = center><strong>Accession No</strong></td>


  </tr>";

if ($getquery->num_rows !=0){

while($runrows = $getquery->fetch_assoc())
{
$title = $runrows ['title'];
$author = $runrows ['author'];
$status2 = $runrows ['status2'];
$location = $runrows ['location'];
   $image_name2 =$runrows ['image_name2'];
    $toc =$runrows ['toc'];
	 $accessNum =$runrows ['accessNum'];
  

 echo  "<tr>";
  echo "<td align = center> <strong> $title</strong></td>";
    echo "<td align = center>  $author</td>";
echo "<td width = 100 align = center class=sub><a href = 'files/$image_name2'>view content</a></td>";
    echo "<td align = center><a href = 'view_books2.php' onclick='return confirm('are you sure')'>$status2 </a></td>";
    echo "<td align = center>$location</td>";
	echo "<td align = center>$accessNum</td>";


  "</tr>";
}
 echo "</table>";
 }

//Pagination Starts
echo"<ul class='pagination'>";
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=$prev' class='page'>Prev</a></li> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i' class='page'><b>$counter</b></a><li> ";
}
else {
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i' class='page'>$counter</a></li> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=$i' class='page active'><b>$counter</b></a></li> ";
}
else {
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=$i' class='page'>$counter</a> </li>";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=0' class='page'>1</a> </li>";
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=$per_page' class='page'>2</a> .... </li>";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i'class='page active'><b>$counter</b></a></li> ";
}
else {
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i' class='page'>$counter</a> </li>";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=0' class='page'>1</a></li> ";
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$per_page' class='page'>2</a> ....</li> ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i' class='page'><b>$counter</b></a></li> ";
}
else {
echo " <li><a href='search_content.php?e_mail=$e_mail&search=$search&submit=Search+source+code&start=$i' class='page'>$counter</a> </li>";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <li><a href='search_content.php?search=$search&submit=Search+source+code&start=$next' class='page'>Next</a></li> ";    
}   
echo "</center>";
} 
} 
echo "</ul>";

?>


						</section>

						</div>
					</div>

				<!-- Sidebar -->

							<!-- Menu -->
							<?php 
	include 'menu2.php';
	
?>	


							<!-- Section -->

							<!-- Footer -->

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>