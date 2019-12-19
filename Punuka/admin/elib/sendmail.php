<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<script src="assets/media/js/jquery.js"></script>
		
		<style>
	.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/loading_big1.gif') 50% 50% no-repeat rgb(249,249,249);
}
	</style>
	</head>
	<body>
	<div class="loader"></div>
	script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
	</body>
	</html>
<?php
$mail = $_POST["r_mail"];
$fname = $_POST["r_name"];
$mail_title = $_POST["m_title"];
$mail_content = $_POST["m_content"];

echo "<input type=\"hidden\" id=\"e_mail\" value=\"$mail\" />";
echo "<input type=\"hidden\" id=\"f_name\" value=\"$fname\" />";
echo "<input type=\"hidden\" id=\"mail_title\" value=\"$mail_title\" />";
echo "<input type=\"hidden\" id=\"mail_content\" value=\"$mail_content\" />";


 echo"<script>
 (function(){
	 var fname = encodeURI(document.getElementById('f_name').value);
	 var email = encodeURI(document.getElementById('e_mail').value);
	 var mail_title = encodeURI(document.getElementById('mail_title').value);
	 var mail_content = encodeURI(document.getElementById('mail_content').value);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('post','../send_user_mail.php?fname='+fname+'&email='+email+'&mail_title='+mail_title+'&mail_content='+mail_content,true);
xml.send();
 })();
</script>
 ";
sleep(4);
 header( "refresh:0;url=edit_user.php" );
   //header("Location: edit_user.php");
   //sleep(5);

?>