<!--The following program shows how to build map mashups     该代码用于如何建立多个地图混搭-->

<!DOCTYPE HTML>
<html>
 <body>
  Click the button to mark your position:
  <button onclick="getLocation( )">Mark It!</button>
  <p id="mapholder"></p>

  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApe1G2ynYIqWc4ej2LtdknkZPCm8ccDiQ&v=3.exp"></script> -->
  <script>
   var  mapholder = document.getElementById( "mapholder" );

   function  getLocation( ) {
    if ( navigator.geolocation )
	console.log(navigator);
     navigator.geolocation.getCurrentPosition( showPosition, showError );
    else
     mapholder.innerHTML = "Geolocation is not supported by this browser.";
   }

   function  showPosition( position ) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng( lat, lon );
    mapholder.style.height ='400px';
    mapholder.style.width  ='700px';

    var  myOptions = {
     center: latlon,
     zoom: 14,
     mapTypeId: google.maps.MapTypeId.ROADMAP,
     mapTypeControl: false,
     navigationControlOptions: {
      style: google.maps.NavigationControlStyle.SMALL
     }
    };

    var  map = new google.maps.Map( document.getElementById( "mapholder" ), myOptions );
    var  marker = new google.maps.Marker( {
     position: latlon,
     map: map,
     title: "You are here!" }
    );
   }

   function  showError( error ) {
    switch( error.code ) {
     case error.PERMISSION_DENIED:
      mapholder.innerHTML = "User is denied the request for Geolocation.";
      break;
     case error.POSITION_UNAVAILABLE:
      mapholder.innerHTML = "Location information is unavailable.";
      break;
     case error.TIMEOUT:
      mapholder.innerHTML = "The request to get user location timed out.";
      break;
     case error.UNKNOWN_ERROR:
      mapholder.innerHTML = "An unknown error occurred.";
      break;
    }
   }
  </script>
 </body>
</html>