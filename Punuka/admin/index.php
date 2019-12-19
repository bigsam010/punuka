<?php
	session_start();
	include "db_conn.php";
	if (!isset ($_SESSION["username"])){
		header("Location: ../index.php");
	}else{
	$get_user=$_SESSION["username"];
	$_SESSION["admin"]=$get_user;
	}
	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="loading">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>Punuka Library App</h1>
				<p>One app that gives you access to the digital library, electronic catalogue<br />
				and the treasury file request system</p>
						<nav>
							<ul>
								<li><a href="elib/index.php"><img src="assets/css/images/lib.png" height="75" width="75"></a>eLibrary</li>
								<li><a href="file/index.php"><img src="assets/css/images/cabinet.png" height="75" width="75"></a>File Request</li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; Punuka Attorneys & Solicitors</span>
					</footer>

			</div>
		</div>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script>
			window.onload = function() { document.body.className = ''; }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>