<?php
header("Content-Type: text/html; charset=UTF-8");  
	
	$other1=$_GET['other1'];
	$other2=$_GET['other2'];
	include("conn.php");
	$sql = "insert into history_location (other1,other2) values('$other1','$other2') ";					
	$query = mysql_query($sql) or die(mysql_error());	
	
	// while ( $row = mysql_fetch_array ( $query ) )  
	// {  
		// $response [] = $row;  
	// }  
	// foreach ( $response as $key => $value )  
	// {  
		// $newData[$key] = $value;  
		
	// }  
	
	// echo urldecode ( json_encode ( array("data"=>$newData) )); 
	echo urldecode ( json_encode ( "remember location success" )); 
	// echo $response;
	
?>