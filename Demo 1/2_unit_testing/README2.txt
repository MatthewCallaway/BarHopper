
- We have two main unit tests, loading the api library to find current location, and querying all the bars around.

- We load our library with async and defer in order to ensure proper DOM loading.

<script aysnc defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy6h-EOS_JtZoLTrmFSHzy5A66Ew6712s&libraries=places"></script>

- We then wait on the login in order to use this script with a gapi call (Google API).

navigator.geolocation.getCurrentPosition(function(position))

- This snippet of code will generate an alert to allow current location to be used and if accepted, holds the lat and lang of the current user.

this.map = new google.maps.Map(document.getElementById('map')

- This code will load the map based on lang and lat.

var bounds = new google.maps.LatLngBounds();
      var placesList = document.getElementById('places');

      for (var i = 0, place; place = places[i]; i++) {
        var image = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

- The code above is run when the location are being loaded around the current lang and lat and will create markers on the map where bars are.