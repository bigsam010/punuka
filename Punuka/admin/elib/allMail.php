
<?php
include "db_conn.php";
$currentdate=date('Y-m-d');

$mail_title = $_POST["m_title"];
$mail_content = $_POST["m_content"];
$location = $_POST["location_m"];



$allmail = array();
$resultset = $mysqli->query("SELECT e_mail FROM borrowers where due_date <=('$currentdate') AND (location='$location' AND status='')");
$foundnum = $resultset->num_rows; 
if($resultset->num_rows !=0){
	 while($rows = $resultset->fetch_assoc()){
		$mail[] = $rows;
	 }
	 
$mails = serialize($mail);
echo "<input type=\"hidden\" id=\"mail_title\" value=\"$mail_title\" />";
echo "<input type=\"hidden\" id=\"mail_content\" value=\"$mail_content\" />";
echo "<input type=\"hidden\" id=\"mail_ids\" value=\"$mails\" />";

var_dump($mails);
echo"<script>
window.open('../send_multi_user_mail.php?mail_ids=$mails&mail_title=$mail_title&mail_content=$mail_content');
</script>
 ";

  /* echo"<script>
 (function(){
	 xml.open('post','../send_multi_user_mail.php?mail_ids='+mail_ids+'&mail_title='+mail_title+'&mail_content='+mail_content,true);
	 
	 var mail_title = encodeURI(document.getElementById('mail_title').value);
	 var mail_content = encodeURI(document.getElementById('mail_content').value);
	 var mail_ids = encodeURI(document.getElementById('mail_ids').value);
	 
	 alert(mail_ids);
	 if (window.XMLHttpRequest)
  {
  var xml=new XMLHttpRequest();
  }
else
  {
  xml=new ActiveXObject(\"Microsoft.XMLHTTP\");
  }
 
   
xml.open('post','../send_multi_user_mail.php?mail_ids='+mail_ids+'&mail_title='+mail_title+'&mail_content='+mail_content,true);
xml.send();
 })();
</script>
 "; */
		
	 
}




//sleep(4);
 //header( "refresh:0;url=overdue_books.php" ); 
   //header("Location: edit_user.php");
   //sleep(5);

?>