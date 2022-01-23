<?php
	require_once "include/session.php";
	require_once "include/mysqli.php";
		$status = $_SESSION["status"];
	if(strcasecmp($status,"")==0){
	header("Location: /");}
	if(strcasecmp($status,"user")==0){
	header("Location: /");}

	db_connect();
	
	$id = $_GET["product"];
	db_delete_product($id);
 
$back = $_SERVER['HTTP_REFERER']; 
echo "
<html>
  <head>
   <meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>
  </head>
</html>";
?>