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
	if(isset($_GET['title'])){
	$bookTitle = $_GET['title'];
	$bookNum = $_GET['booknum'];
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
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<script src="dist/sweetalert.min.js"></script>
			<script src="assets/js/jquery.min.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<script src="assets/js/soop.js"></script>
	<script>

	</script>
	<style>
	#titleList ul{
		background-color: #eee;
		cursor: pointer;
	}
	#titleList ul li{
		padding: 5px;
	}
	#nameList ul{
		background-color: #eee;
		cursor: pointer;
	}
	#nameList ul li{
		padding: 5px;
	}
	#etitleList ul{
		background-color: #eee;
		cursor: pointer;
	}
	#etitleList ul li{
		padding: 5px;
	}
	.conf{
		position:fixed;
		top: 0;
		left: 50%;
		z-index:100000;
		padding:.5em 1em;
		background-color:green;
		color:#fff;
		display:none;
	}
	.maxi{
		position:fixed;
		top: 0;
		left: 50%;
		z-index:100000;
		padding:.5em 1em;
		background-color:red;
		color:#fff;
		display:none;
	}
	.fill{
		position:fixed;
		top: 0;
		left: 50%;
		z-index:100000;
		padding:.5em 1em;
		background-color:red;
		color:#fff;
		display:none;
	}
	
	</style>
	</head>
	<body>
<center>
<div class="conf">Book added...</div>
<div class="maxi">Limit reached...</div>
<div class="fill">Please fill all the boxes</div>
</center>												
<?php
$currentdate=date('Y-m-d');

$resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");

if ($resultset->num_rows !=0){


while ($rows = $resultset->fetch_assoc())

{

$location = $rows ['location'];


}


}

?>
<?php

$currentdate=date('Y-m-d');


$date_arr=explode('-',$currentdate);


$next_date= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+1,$date_arr[0]));

$next_date2= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+2,$date_arr[0]));

$next_date3= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+3,$date_arr[0]));

$next_date4= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+4,$date_arr[0]));

$next_date5= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+5,$date_arr[0]));

$next_date6= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+6,$date_arr[0]));

$next_date7= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+7,$date_arr[0]));

$next_date14= Date("Y-m-d",mktime(0,0,0,$date_arr[1],$date_arr[2]+14,$date_arr[0]));
?>
<div class="modal">
<div class="modal_close close"></div>
<div class="flashscreen mode">
<img src="images/i783wQYjrKQ.png" class="close ic">
<form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="">
<input class="onon" name="staff_id" id="daccessNum" placeholder="Enter accession number" autocomplete="off" required>
<input class="onon " name="fname" id='etitle' placeholder="Book title" autocomplete="off" readonly>
<center>
<div id="etitleList" style="width:85%; position:absolute; z-index:100;"></div>
</center>
<center>
<select name="due_date" id="dueDate" style="margin-top:10px;width:85%;margin-left: -21px;" required>
<option value="">Due Date</option>
<option value="">.......</option>
<option value="<?php echo "$next_date"; ?>">1 day</option>
<option value="<?php echo "$next_date2"; ?>">2 days</option>
<option value="<?php echo "$next_date3"; ?>">3 days</option>
<option value="<?php echo "$next_date4"; ?>">4 days</option>
<option value="<?php echo "$next_date5"; ?>">5 days</option>
<option value="<?php echo "$next_date6"; ?>">6 days</option>
<option value="<?php echo "$next_date7"; ?>">1 week</option> 
<option value="<?php echo "$next_date14"; ?>">2 weeks</option>

</select>
</center>
<div class="fox tilty" style="margin-top:20px;">
<button class="mo ed add">Add</button>
<div class="mo k">Cancel</div>
</div>
</form>
</div>
</div>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Borrow a Book</strong></a>
									<ul class="icons">
										<li><a href="index.php"><strong>Home</strong> </a></li>
									</ul>

								</header>

							<!-- Banner -->



 
							<!-- Section -->
								<section>


<center>
	<p id="error"></P>											
<form action='' method='POST'>
Fill in the following:
<div >

<input type="search" id="staff_names" size='70' name="staff_id" id="demo-category" placeholder='Enter Borrower Name' autocomplete="off" required>  
<div id="nameList" style="width:65%;"></div>
<input id='loc' style="display:none;" value="<?=$location?>">
<input <?php if(isset($bookTitle)){echo"value='$bookNum'";}?> type="tel" size='70' name='accessNum[]' id="accessNum" placeholder='Enter Accession number' required>
<input <?php if(isset($bookTitle)){echo"value='$bookTitle'";}?> type="search" size='70' name='title[]' id='title' placeholder='Book Title' autocomplete="off" readonly>
<div id="titleList" style="width:65%;"></div>
<select name="due_date[]" id="demo-category" style="margin-top:10px;" required>
<option value="">Due Date</option>
<option value="">.......</option>
<option value="<?php echo "$next_date"; ?>">1 day</option>
<option value="<?php echo "$next_date2"; ?>">2 days</option>
<option value="<?php echo "$next_date3"; ?>">3 days</option>
<option value="<?php echo "$next_date4"; ?>">4 days</option>
<option value="<?php echo "$next_date5"; ?>">5 days</option>
<option value="<?php echo "$next_date6"; ?>">6 days</option>
<option value="<?php echo "$next_date7"; ?>">1 week</option> 
<option value="<?php echo "$next_date14"; ?>">2 weeks</option>

</select>
<div id="formy">
<div id="f"></div>
</div>
<div class="nock">
<input type='submit' class="button special" name='submit' value='Borrow'> <button class="fish borrow" title="Borrow more" disabled>Borrow more</button>
</div>
</center>
</form>





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
		
		
			<script src="assets/js/main.js"></script>
<?php

 if(isset($_POST["submit"])){
	 
		/* $titlee = $_POST['title'];
		$numbs = $_POST['accessNum']; */
		
	 
  $sname = $_POST["staff_id"];
  
  $accessNums = $_POST["accessNum"];
   $due_dates = $_POST["due_date"];
   if($user_name=='General-admin'){
	   $query = $mysqli->query ("SELECT staff_id FROM users where full_name='$sname'");
	if($query->num_rows>0){
		 while($row= $query->fetch_assoc()){
			 $bstaff_id = $row['staff_id'];
		 }
 
	}
	   $check_access = $mysqli->query ("select * from entry where accessNum = '$accessNums[0]'");

if ($check_access->num_rows<=0){
	
	echo "<script>swal({
  title: 'Error!',
  text: 'Access Number is not available',
  type: 'error',
  timer: 4000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='borrow_book.php';
},4000);
</script>";


}else{
	$accessNum = serialize($accessNums);
	$due_date = serialize($due_dates);
 echo "<script>window.open('borrow_confirm.php?staff_id=$bstaff_id&accessNum=$accessNum&due_date=$due_date','_self')</script>";
// header("Location: borrow_confirm.php?staff_id=".$staff_id."&accessNum[]=".$accessNum."&due_date=".$due_date);

}
   }else{
	   $query = $mysqli->query ("SELECT staff_id FROM users where full_name='$sname'");
	if($query->num_rows>0){
		 while($row= $query->fetch_assoc()){
			 $bstaff_id = $row['staff_id'];
		 }
 
	}
	   $check_access = $mysqli->query ("select * from entry where accessNum = '$accessNums[0]' AND location='$location'");

if ($check_access->num_rows<=0){
	
	echo "<script>swal({
  title: 'Error!',
  text: 'Access Number is not available',
  type: 'error',
  timer: 4000,
  showConfirmButton: false
});
setTimeout(function(){
	window.location.href='borrow_book.php';
},4000);
</script>";


}else{
	$accessNum = serialize($accessNums);
	$due_date = serialize($due_dates);
 echo "<script>window.open('borrow_confirm.php?staff_id=$bstaff_id&accessNum=$accessNum&due_date=$due_date','_self')</script>";
// header("Location: borrow_confirm.php?staff_id=".$staff_id."&accessNum[]=".$accessNum."&due_date=".$due_date);

}
   }
  
   

}
?>
<script>
$(document).ready(function(){
	$('#accessNum').keyup(function(){
		$('.borrow').prop('disabled', false);
		var query = $(this).val();
		var location = $('#loc').val();
		if(query.length >= 2){
			$.ajax({
				<?php
				if($user_name == "General-admin"){
					echo"
					url:'gtitlesearch.php',
				method:'POST',
				data:{query:query, location:location},
					";
				}else{
					echo"
					url:'titlesearch.php',
				method:'POST',
				data:{query:query, location:location},
					";
				}
				?>
				success:function(data){
					$('#title').val(data);
				}
			});
		}else{
					// $('#titleList').fadeOut();
					$('.borrow').prop('disabled', true); 
					$('#title').val('');
				}
	});
	
	if($('#title').val() != ''){
		$('.borrow').prop('disabled', false);
	}
/* 	$(document).on('click', '#titleList li', function(){
		$('#title').val($(this).text());
		$('#titleList').fadeOut();
		$('.borrow').prop('disabled', false);
		var note = $('#title').val();
		var location = $('#loc').val();
		if(note != ''){
			$.ajax({
				url:"getNumb.php",
				method:"POST",
				data:{note:note, location:location},
				success:function(data){
					$('#accessNum').val(data);
				}
			});
		}
	});
	 */
	
});


$(document).ready(function(){
	$('#daccessNum').keyup(function(){
		var query = $(this).val();
		var location = $('#loc').val();
		if(query.length >= 2){
			$.ajax({
				<?php
				if($user_name == "General-admin"){
					echo"
					url:'gtitlesearch.php',
				method:'POST',
				data:{query:query, location:location},
				
					";
				}else{
					echo"
					url:'titlesearch.php',
				method:'POST',
				data:{query:query, location:location},
					";
				}
				?>
				success:function(data){
					//$('#etitleList').fadeIn();
					$('#etitle').val(data);
				}
			});
		}else{
					$('#etitle').val('');
					
				}
	});
/* 	$(document).on('click', '#etitleList li', function(){
		$('#etitle').val($(this).text());
		$('#etitleList').fadeOut();
		var note = $('#etitle').val();
		var location = $('#loc').val();
		if(note != ''){
			$.ajax({
				url:"getNumb.php",
				method:"POST",
				data:{note:note, location:location},
				success:function(data){
					$('#daccessNum').val(data);
				}
			});
		}
	}); */
	
	
});
	
	
$(document).ready(function(){
	$('#staff_names').keyup(function(){
		var query = $(this).val();
		var location = $('#loc').val();
		if(query != ''){
			$.ajax({
			<?php
				if($user_name == "General-admin"){
					echo"
					url:'gnamesearch.php',
				method:'POST',
				data:{query:query, location:location},
					";
				}else{
					echo"
					url:'namesearch.php',
				method:'POST',
				data:{query:query, location:location},
					";
				}
				?>
				success:function(data){
					$('#nameList').fadeIn();
					$('#nameList').html(data);
				}
			});
		}else{
					$('#nameList').fadeOut();
				}
	});
	$(document).on('click', '#nameList li', function(){
		$('#staff_names').val($(this).text());
		$('#nameList').fadeOut();
		
	});
	
	
});

$(document).ready(function(){
  $(".borrow",this).click(function(e){
	e.preventDefault();
	$("input#etitle").val('');
	$("input#daccessNum").val('');
	$("select#dueDate").val('');
	$(".modal").fadeIn();
	$(".flashscreen").show();
	
	
	  });
});	


$(document).ready(function(){
  $(".close").click(function(){
	$(".modal").fadeOut();
	$(".flashscreen").fadeOut();
	  });
});

$(document).ready(function(){
  $("div.k").click(function(){
	$(".modal").fadeOut();
	$(".flashscreen").fadeOut();
	  });
});


	$(document).ready(function(){
		var max_fields = 2;
		 var x = 0;
	
  $(".add").click(function(e){
	e.preventDefault();
	var dem = $("input#etitle").val();
	var gem = $("input#daccessNum").val();
	var hem = $("select#dueDate").val();
	if(dem != '' && hem != ''){
	if(x < max_fields){
            x++;
	 $("<input type='text' class='g_field' readonly />")
	 .val(gem)
     .attr("id", "myfieldid")
     .attr("name", "accessNum[]")
     .appendTo("#formy");
	 $("<input type='text' class='m_field' readonly/>")
	 .val(dem)
     .attr("id", "myfieldid")
     .attr("name", "title[]")
     .appendTo("#formy");
	  $("<input type='hidden' class='dueDate' readonly /><a href='#' class='remove_field'>Remove</a>")
	 .val(hem)
     .attr("id", "myfieldid")
     .attr("name", "due_date[]")
     .appendTo("#formy");
	 $('.conf').fadeIn('fast').delay(1000).fadeOut('fast');
	 $(".remove_field").removeAttr("name");
	 //$(".m_field").val(dem);
	 //$(".g_field").val(gem);
	  //$('.m_field').next().val(dem);
	 $("input#etitle").val('');
	$("input#daccessNum").val('');
	$("select.dueDate").val('');
	 $(".modal").fadeOut();
	$(".flashscreen").fadeOut();
	}else{
		$('.maxi').fadeIn('fast').delay(2000).fadeOut('fast');
	}
	}else{
		$('.fill').fadeIn('fast').delay(4000).fadeOut('fast');
	}
	  });
	  $(document).on("click", ".remove_field", function(e){
        e.preventDefault();
		$(this).prevUntil('a').remove();
		$(this).remove();
		
		x--;
    });
});
	
	
	
$(window).load(function() {
	var tuts = $('#title').val()
	if(tuts != ''){
		$('.borrow').prop('disabled', false);
	}
});
	
	
</script>
	</body>
</html>