
<html>
	<head>
		<!-- <script type="text/javascript" src="js/prototype-1.6.0.3.js"></script> -->
		<script type="text/javascript" src="js/my.js"></script>
		<!-- <script type="text/javascript" src="js/main.js"></script>  -->
	</head>
	<body style="font-size:30px;" onload="quoto()">
	
				<table width="100%">
					<thead>
						<tr> <td>ISBN</td> <td>TITLE</td> <td>PRICE</td> </tr>
					</thead>  
					<tbody id="tb1">
					</tbody>
				</table>
	</body>
	<script>
		function quoto(){
			var url="getStock.php"
			url=url+"?sid="+Math.random();
			var xhttp = GetXmlHttpObject();
			<!-- var xhttp = new XMLHttpRequest(); -->
			xhttp.onreadystatechange = function(){
				console.log(xhttp);
				
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					var str = xhttp.responseText;
					console.log(str);
					 var arr = eval(str); 
					<!-- var arr = JSON.stringify(str);  -->
					console.log(arr);
					var htmlContent = ""; 
					for(i = 0;i < arr.length;i ++){ 
					   var s = arr[i];
					   htmlContent += 
					   "<tr><td>" + s.ISBN +"</td><td>" + s.title + "</td><td>" + s.price + "</td></tr>";
						
					}
				   document.getElementById("tb1").innerHTML = htmlContent
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}
	</script>
</html>
