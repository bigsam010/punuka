<?php
include 'db_conn.php';
$query = $mysqli->query("SELECT profile_pic,full_name FROM users WHERE e_mail = '$e_mail' ");
$result = $query->fetch_assoc();
$profile_pic = $result['profile_pic'];
$full_name = $result['full_name'];
$pieces = explode(" ", $full_name);
?>

<div id="sidebar">
<div class="inner">
<!-- Search -->
<section id="search" class="alt" style="margin-bottom: 25px;">                          
<img src="images/punuka logo new.png"  width="140" height="95" alt="Logo" align="middle" style="margin-left:30px;"/>
</section>
<nav id="menu">
<header class="major">
<h2><img src="user_images/<?=$profile_pic?>" class="prof"/><p class="kill"><b>Hi <?=$pieces[0];?></b></p></h2>
</header>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="#" class="you">E-library <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
<ul class="you">
<li><a href="search.php">Catalogue</a></li>
<li><a href='search_by_location.php'>Search By Location</a></li>
<li><a href="borrow_history.php">My Borrow History</a></li>
<li>
	<a href="borrow_book.php">Borrow a Book</a>
</li>
<li><a href="suggest_book.php">Suggest a Book</a></li>
<li>
<a href="overdue_books.php">Overdue Books</a>
</li>
<li>
<a href="requests.php">Requested Books</a>
</li>
</ul>
</li>
<li><a href="#" class="you">E-Books <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
<ul class="you">
<li><a href="search_file.php">Search File</a></li>
<!--<li><a href="suggest_file.php">Suggest a File</a></li>-->
</ul>
</li>
<li><a href="#" class="you">User Profile <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
<ul class="you">
<li><a href="change_password.php">Change Password</a></li>
<li><a href="profile_pic.php">Change Profile Picture</a></li>
</ul>
</li>
<li style="padding-bottom: 0;margin-bottom: 0;"><a href="logout.php">Logout</a></li>
</ul>
								</nav>
								<footer id="footer">
									<p class="copyright">&copy; Punuka Attorneys & Solicitors. All rights reserved.</p>
								</footer>
						</div>
					</div>
<div class="toggler mamma">
<label class="tog">☰</label>
</div>
<div class="toggler secguy" style="display:none; left:20px;">
<label class="tog">☰</label>
</div>
<script>
				$(document).ready(function(){
					$('.toggler').click(function(){
						
						$('#sidebar').toggle(1000,function(){
							$('.toggler').toggle();
						});
						
					});
				});
</script>