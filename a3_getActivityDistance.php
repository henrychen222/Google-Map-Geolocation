<?php
header("Content-Type: text/html; charset=UTF-8");  
	
	include("conn.php");
	$sql = "SELECT * FROM activity_distance WHERE type = '$_GET[typeName]' ";					
	$query = mysql_query($sql) or die(mysql_error());	
	
	while ( $row = mysql_fetch_array ( $query ) )  
	{  
		$response [] = $row;  
	}  
	foreach ( $response as $key => $value )  
	{  
		$newData[$key] = $value;  
		// $newData [$key] ['title'] = urlencode ( $value ['title'] );  //key 重复则改值
		// $newData [$key] ['price'] = urlencode ( $value ['price'] );  
		// $newData [$key] ['ISBN'] = urlencode ( $value ['ISBN'] );  
		// $newData [$key] ['asasda'] = urlencode ( $value ['ISBN'] );//  key 不重复则$newData在数组新增键值对
	}  
	
	// echo urldecode ( json_encode ( array("data"=>$newData) )); 
	echo urldecode ( json_encode ( $newData )); 
	// echo $response;
	
?>