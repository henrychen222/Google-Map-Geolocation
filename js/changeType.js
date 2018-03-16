function changeType(typeName) {
	var url="a3_getEnd.php"
	url=url+"?sid="+Math.random();
	url=url+"&typeName="+typeName;
	console.log(url);
	var xhttp = GetXmlHttpObject();
	
	xhttp.onreadystatechange = function(){
		
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var str = xhttp.responseText;
			console.log(str);
			 var arr = eval(str); 
			<!-- var arr = JSON.stringify(str);  -->
			console.log(arr);
			var htmlContent = ""; 
		    var select = document.getElementById("select01")
			console.log(select.options.length);
		    select.options.length=arr.length;
			console.log(select.options.length);
			for(var i=0; i<select.options.length; i++){
				select.options[i].innerHTML = arr[i].other1;
				select.options[i].value = arr[i].location_name;
				showPosition( 47.92525699999999+i*20, -97.032855+i*20,arr[i].activity_detail);
			}			
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}
function  showPosition( lat,lng,detail ) {
	alert(lat,lng,detail);
    var marker = new google.maps.Marker( {
     position: latlon = new google.maps.LatLng( lat, lng ),
     map: map,
     title: detail }
    );
	
   }
