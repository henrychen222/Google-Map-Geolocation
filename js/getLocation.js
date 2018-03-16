	var currentLocation = "";

   function  getLocation( ) {
    if ( navigator.geolocation ) {
     navigator.geolocation.getCurrentPosition( showPosition, showError );
	}else{
     currentLocation = "Geolocation is not supported by this browser.";
	 alert(currentLocation);
	}
   }

   function  showPosition( position ) {
    currentLocation  = "Latitude: "  + position.coords.latitude; 
    currentLocation += "Longitude: " + position.coords.longitude;
	console.log("获取实时坐标" + currentLocation );
   }

   function  showError( error ) {
    switch ( error.code ) {
     case error.PERMISSION_DENIED:
      currentLocation = "User is denied the request for Geolocation.";
	  alert()
      break;
     case error.POSITION_UNAVAILABLE:
      currentLocation = "Location information is unavailable.";
      break;
     case error.TIMEOUT:
      currentLocation = "The request to get user location timed out.";
      break;
     case error.UNKNOWN_ERROR:
      currentLocation  = "An unknown error occurred.";
      break;
    }
   }