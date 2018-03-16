<?php
header("Content-Type: text/html; charset=UTF-8");  
	
	include("conn.php");
	$sql = "SELECT * FROM citynews  WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM citynews ) ORDER BY id LIMIT 1 ";					
	$query = mysql_query($sql) or die(mysql_error());	
	
	while ( $row = mysql_fetch_array ( $query ) )  
	{  
		$response [] = $row;  
	}  
	foreach ( $response as $key => $value )  
	{  
		$newData[$key] = $value;  
		
	}  
	
	// echo urldecode ( json_encode ( array("data"=>$newData) )); 
	echo urldecode ( json_encode ( $newData )); 
	// echo $response;
	
?>