<?php
header("Content-Type: text/html; charset=UTF-8");  
	
	include("conn.php");
	$sql = "SELECT * FROM customer WHERE name = '$_GET[name]' ";					
	$query = mysql_query($sql) or die(mysql_error());					
	$rs = mysql_fetch_array($query);
	
	if(empty($rs['id']))
	{	
		echo urldecode ( json_encode ( "empty" )); 
	}else{
		echo urldecode ( json_encode ( "used" )); 
	}
	
?>				


	