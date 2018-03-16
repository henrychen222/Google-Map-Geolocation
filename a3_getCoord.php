<!--The following program shows how to find the user’s current latitude and longitude     该代码用于如何找出用户当前的经纬度-->

<!DOCTYPE HTML>
<html>
 <body>
  Click the button to get your coordinates:  
  <button onclick="getLocation( )">Get Them!</button>
  <p id="demo"></p>

  <script>
   var  x = document.getElementById( "demo" );

   function  getLocation( ) {
    if ( navigator.geolocation ) 
     navigator.geolocation.getCurrentPosition( showPosition, showError );
    else
     x.innerHTML = "Geolocation is not supported by this browser.";
   }

   function  showPosition( position ) {
    x.innerHTML  = "Latitude: "  + position.coords.latitude; 
    x.innerHTML += "Longitude: " + position.coords.longitude;
   }

   function  showError( error ) {
    switch ( error.code ) {
     case error.PERMISSION_DENIED:
      x.innerHTML = "User is denied the request for Geolocation.";
      break;
     case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable.";
      break;
     case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out.";
      break;
     case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred.";
      break;
    }
   }
  </script>
 </body>
</html>