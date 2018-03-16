<!--The following program shows how to draw a direction     （该代码用于如何展示路线导航）-->

<!DOCTYPE HTML>
<html>
 <head>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApe1G2ynYIqWc4ej2LtdknkZPCm8ccDiQ&v=3.exp"></script>
  <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyApe1G2ynYIqWc4ej2LtdknkZPCm8ccDiQ"></script> -->
  <script type="text/javascript" src="js/my.js"></script>
  <!-- <script type="text/javascript" src="js/changeType.js"></script> -->
  <script>
   var  directionsDisplay;
   var  directionsService = new google.maps.DirectionsService();
   var  map;
   var  latlon;
   var  marker;
   var  travleTypeStatistics = google.maps.DirectionsTravelMode.WALKING;
   var  markArray ;
	<!--初始化地图-->
   function  initialize(){
		directionsDisplay = new google.maps.DirectionsRenderer();
		
		var  GF = new google.maps.LatLng( 47.92525699999999, -97.032855 );
		var  mapOptions = {
		 zoom: 14,
		 mapTypeId: google.maps.MapTypeId.ROADMAP,
		 center: GF,
		 mapTypeControl: false,
		 navigationControlOptions: {
		  style: google.maps.NavigationControlStyle.SMALL
		 }
		}
		map = new google.maps.Map( document.getElementById('map_canvas'), mapOptions);
		directionsDisplay.setMap( map );
		
  		setInterval(getNews,5000);<!--定时刷新-->
   }
	
	<!--标记位置-->
	function  getLocation( ) {
		if ( navigator.geolocation ){
		console.log(navigator);
		 navigator.geolocation.getCurrentPosition( showPosition, showError );
		 
		}
   }

   function  showPosition( position ) {
   	console.log(111);
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    console.log(222);
	<!-- 获取当前位置-->
    latlon = new google.maps.LatLng( lat, lon );
	<!--latlon = new google.maps.LatLng( 47.92525699999999, -97.032855 ); -->
    console.log(latlon);

    var  myOptions = {
     center: latlon,
     zoom: 14,
     mapTypeId: google.maps.MapTypeId.ROADMAP,
     mapTypeControl: false,
     navigationControlOptions: {
      style: google.maps.NavigationControlStyle.SMALL
     }
    };

    <!-- map = new google.maps.Map( document.getElementById('map_canvas'), myOptions ); -->
    marker = new google.maps.Marker( {
     position: latlon,
     map: map,
     title: "You are here!" }
    );
	directionsDisplay = new google.maps.DirectionsRenderer();
	directionsDisplay.setMap( map );//显示标记
	console.log("getLocation success,lat:" + lat+",lon:" + lon);
	<!-- marker.setMap( map ); -->
   }

   function  showError( error ) {
      console.log(error);
   }
   <!--推荐-->
   function changeType(typeName) {
	var url="a3_getEnd.php"
	url=url+"?sid="+Math.random();
	url=url+"&typeName="+typeName;
	console.log(url);
	var xhttp = GetXmlHttpObject();
	
	xhttp.onreadystatechange = function(){
		directionsDisplay.setMap(null);
		directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setMap( map );
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var str = xhttp.responseText;
			console.log(str);
			 var arr = eval(str); 
			<!-- var arr = JSON.stringify(str); -->
			console.log(arr);
			var htmlContent = ""; 
		    var select = document.getElementById("select01")
			console.log(select.options.length);
		    select.options.length=arr.length;
			console.log(select.options.length);
			if(markArray!=null){
				for(var i=0; i<markArray.length; i++){
					markArray[i].setMap(null);
				}
			}
			markArray = new Array();
			for(var i=0; i<select.options.length; i++){
				select.options[i].innerHTML = arr[i].billboard;
				select.options[i].value = arr[i].location_name;
				<!--多个标记-->
				
				var latlons = new google.maps.LatLng( parseFloat(arr[i].other1), parseFloat(arr[i].other2) );
				console.log(arr[i].other1);
				console.log(arr[i].other2);
				var markers = new google.maps.Marker( {
				 position: latlons,
				 map: map,
				 title: arr[i].activity_detail }
				);	
				markers.setMap(map);
				markArray[i] = markers;
			}
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}
	<!-- 绘制路线-->
   function calcRoute( ) {
    var  start = document.getElementById('start').value;
    var  end   = document.getElementById('end').value;
    var  request = {
     origin: start,
     destination: end,
     travelMode: travleTypeStatistics,
	 provideRouteAlternatives:true
    };
    directionsService.route( request, function( response, status ) {
     if ( status == google.maps.DirectionsStatus.OK )
      directionsDisplay.setDirections( response );
     } );
   }
   
   function calcRoute1() {
		marker.setMap(null);
		for(var i=0; i<markArray.length; i++){
			markArray[i].setMap(null);
		}
		 var  start = latlon;
		var  end   = document.getElementById('select01').value;
		<!-- alert(start); -->
		var  request = {
		 origin: start,
		 destination: end,
		 travelMode: travleTypeStatistics,
		 provideRouteAlternatives:true
		};
		directionsService.route( request, function( response, status ) {
		 if ( status == google.maps.DirectionsStatus.OK )
		  directionsDisplay.setDirections( response );
		  else
		  alert("failed sesson : "+status)
		 } );
   }
   
   function showRoute( ) {
   if(markArray!=null){
		for(var i=0; i<markArray.length; i++){
			markArray[i].setMap(null);
		}
	}
    var a = document.getElementById('route');
	var b = document.getElementById('select');
    a.style.display="block";
	b.style.display="none";
	marker.setMap(null);
	directionsDisplay.setMap( null );
	directionsDisplay = new google.maps.DirectionsRenderer();
	directionsDisplay.setMap( map );
   }
   function showSearchType( ) {
	directionsDisplay.setMap(null);
	directionsDisplay = new google.maps.DirectionsRenderer();
	directionsDisplay.setMap( map );
    var a = document.getElementById('route');
	var b = document.getElementById('select');
    a.style.display="none";
	b.style.display="block";
	console.log("开始获取坐标");
	getLocation();
	console.log("结束获取坐标");
	

   }
   <!--城市新闻-->
   function getNews() {
	var url="a3_getNews.php"
	url=url+"?sid="+Math.random();
	var xhttp = GetXmlHttpObject();
	
	xhttp.onreadystatechange = function(){
		
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var str = xhttp.responseText;
			console.log(str);
			 var result = eval(str); 
			console.log(result);
			var htmlContent = ""; 
		    var select = document.getElementById("cityActivity");
			select.innerHTML = result[0].activity;		
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}
   <!--选择出行方式-->
   function changeTravleMode(i) {
    var travleType = i;
	switch( travleType ) {
     case "1":
      travleTypeStatistics = google.maps.DirectionsTravelMode.WALKING;
	  console.log("WALKING");
	  yourActivity("walking");
	  calcRoute1();
      break;
     case "2":
      travleTypeStatistics = google.maps.DirectionsTravelMode.BICYCLING;
	  console.log("BICYCLING");
	  yourActivity("bicycling");
	  calcRoute1();
      break;
     case "3":
      travleTypeStatistics = google.maps.DirectionsTravelMode.TRANSIT;
	  console.log("TRANSIT");
	  yourActivity("transit");
	  calcRoute1();
      break;
     case "4":
      travleTypeStatistics = google.maps.DirectionsTravelMode.DRIVING;
	  console.log("DRIVING");
	  yourActivity("driving");
	  calcRoute1();
      break;
    }
   }
  
	function yourActivity(typeName) {
		var url="a3_getActivityDistance.php"
		url=url+"?sid="+Math.random();
		url=url+"&typeName="+typeName;
		console.log(url);
		var xhttp = GetXmlHttpObject();
		
		xhttp.onreadystatechange = function(){
			
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var str = xhttp.responseText;
				console.log(str);
				 var result = eval(str); 
				<!-- var arr = JSON.stringify(str);  -->
				console.log(result);
				var htmlContent = ""; 
				var select = document.getElementById("font");
				select.innerHTML = "your " +result[0].type+" distance is: "+result[0].distance+" km";		
			}
		};
		xhttp.open("GET", url, true);
		xhttp.send();
	}
	<!--历史位置-->
	function showHistory(){
		marker.setMap(null);
		directionsDisplay.setMap(null);
		directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setMap( map );
		console.log("statrt with showHistory()");
		var url="a3_getHistoryLocation.php"
		url=url+"?sid="+Math.random();
		var xhttp = GetXmlHttpObject();
		xhttp.onreadystatechange = function(){
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var str = xhttp.responseText;
				console.log(str);
				 var arr = eval(str); 
				<!-- var arr = JSON.stringify(str); -->
				console.log("get Infomation from data:"+ arr);
				if(markArray!=null){
					for(var i=0; i<markArray.length; i++){
						markArray[i].setMap(null);
					}
				}
				markArray = new Array();
				for(var i=0; i<arr.length; i++){
					
					<!--多个标记-->
					
					var latlons = new google.maps.LatLng( parseFloat(arr[i].other1), parseFloat(arr[i].other2) );
					console.log(arr[i].other1);
					console.log(arr[i].other2);
					var markers = new google.maps.Marker( {
					 position: latlons,
					 map: map,
					 title: arr[i].activity_detail }
					);	
					markers.setMap(map);
					markArray[i] = markers;
					console.log("mark Map "+i+"success");
				}
				console.log("end with showHistory()");
			}
		};
	xhttp.open("GET", url, true);
	xhttp.send();
	}
	
	function rememberLocation(){
		
		
		var url="a3_rememberLocation.php"
		url=url+"?sid="+Math.random();
		url=url+"&other1="+lat;
		url=url+"&other2="+lon;
		var xhttp = GetXmlHttpObject();
		xhttp.onreadystatechange = function(){
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var str = xhttp.responseText;
				console.log(str);
				var rememberfont = document.getElementById("rememberfont");
				rememberfont.innerHTML = "upload your current location success";	
			}
		};
	xhttp.open("GET", url, true);
	xhttp.send();
	}
  </script>
 </head>

 <body onload="initialize( )">
 <div>

  you can chose ：
        route<input type="radio" name="sex" value="1" checked="checked" onclick="showRoute()"/>
        doing<input type="radio" name="sex" value="2" onclick="showSearchType()"/>
		&nbsp; &nbsp; &nbsp;City news: &nbsp; &nbsp; <font id="cityActivity"></font>
		
 </div>
<div id = "select" style="display:none;">
 <div id="searchType">
	Search type:
	<select id="type" onChange="changeType(this.value);">
		<option value="shopping">shopping</option>
		<option value="food">food</option>
		<option value="reading">reading</option>
		<option value="coffee">coffee</option>
   </select>
   
   
 </div>
    <div>
	  Travel mode ：
      <select id="travleMode" onChange="changeTravleMode(this.value);">
		<option value="1">WALKING</option>
		<option value="2">BICYCLING</option>
		<option value="3">TRANSIT</option>
		<option value="4">DRIVING</option>
      </select>
      <font id="font"></font>
    </div>
    <div >
       Recommend:
       <select id="select01" onChange="calcRoute1();" >
	   </select>
     </div>
     <div>
	   <input type="button" onclick="rememberLocation();" value="lable">&nbsp; &nbsp; &nbsp; <font id="rememberfont"></font>
     </div>
     <div>
	   <input type="button" onclick="showHistory()" value="show your history path">
	</div>
  </div>
 </div> 
  <div id="route" >
   Start:
   <select id="start" onChange="calcRoute( );" >
    <option value="streibel hall, und, nd">Streibel Hall</option>
    <option value="ray richards golf course, grand forks, nd">Ray Richards</option>
    <option value="ralph engelstad arena,nd">The Ralph</option>
    <option value="university park, grand forks, nd">University Park</option>
    <option value="cabela, east grand forks, mn">Cabela</option>
    <option value="city hall, grand forks, nd">City Hall</option>
    <option value="columbia mall, grand forks, nd">Columbia Mall</option>
   </select>

   End:
   <select id="end" onChange="calcRoute( );">
    <option value="ray richards golf course, grand forks, nd">Ray Richards</option>
    <option value="ralph engelstad arena,nd">The Ralph</option>
    <option value="university park, grand forks, nd">University Park</option>
    <option value="streibel hall, und, nd">Streibel Hall</option>
    <option value="cabela, east grand forks, mn">Cabela's</option>
    <option value="city hall, grand forks, nd">City Hall</option>
    <option value="columbia mall, grand forks, nd">Columbia Mall</option>
   </select>
  </div>
  <div id="map_canvas" style="width:96%;height:400px"></div>
 </body>
</html>
