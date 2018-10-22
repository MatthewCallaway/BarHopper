<template>
  <v-ons-page>
    <ons-toolbar>
      <div class="center">Bars</div>
    </ons-toolbar>
    <section>
      <div class="center">
        <v-ons-input style="border: black; padding:10px; width: 60%;" placeholder="Enter Location..." v-model="geocode">
        </v-ons-input>
        <v-ons-button @click="getCurrentLocation()" modifier="quiet" style="width:30%;line-height: 40px; margin-left: 10px;margin-top:10px;">Clear Map</v-ons-button>
      </div>
      <v-ons-button disabled modifier="large" style="margin: 6px 0; background: goldenrod;" @click="searchLocation()">Search With Chosen Location</v-ons-button>
    </section>
    <div id="map">
    </div>
    <v-ons-button modifier="large" style="margin: 6px 0; background: goldenrod;" @click="loadArea()">Load Locations</v-ons-button>
    <center>
      <v-ons-button id="more" modifier="quiet" style="margin: 6px 0; color: goldenrod;">Load More</v-ons-button>
    </center>
    <v-ons-list-item>
      <div class="center">
        Use Current Location
      </div>
      <div class="right">
        <v-ons-switch @click="switchLocations('current')"></v-ons-switch>
      </div>
    </v-ons-list-item>
    <v-ons-list-item>
      <div class="center">
        Use Specific Address
      </div>
      <div class="right">
        <v-ons-switch @click="switchLocations('specific')"></v-ons-switch>
      </div>
    </v-ons-list-item>
    <div id="places">
    </div>
  </v-ons-page>
</template>
<script>
export default {
  data() {
    return {
      useCurrentLocation: true,
      useChosenLocation: false,
      current_location: null,
      chosen_location: null,
      map: null,
      location: null,
      geocode: null,
    }
  },
  mounted: function() {
    this.getCurrentLocation()
    document.getElementsByTagName("ons-switch")[0].setAttribute("checked");
    document.getElementsByTagName("ons-switch")[1].setAttribute("disabled");
  },
  methods: {
    switchLocations(location) {
      if (location == 'current') {
        this.useCurrentLocation = false
        document.getElementsByTagName("ons-switch")[0].setAttribute("disabled");
        document.getElementsByTagName("ons-switch")[0].removeAttribute("checked");
        document.getElementsByTagName("ons-switch")[1].setAttribute("checked");
        document.getElementsByTagName("ons-switch")[1].removeAttribute("disabled");
        document.getElementsByTagName("ons-button")[1].removeAttribute("disabled");
      } else {
        this.useCurrentLocation = true
        document.getElementsByTagName("ons-switch")[1].setAttribute("disabled");
        document.getElementsByTagName("ons-switch")[1].removeAttribute("checked");
        document.getElementsByTagName("ons-switch")[0].setAttribute("checked");
        document.getElementsByTagName("ons-switch")[0].removeAttribute("disabled");
        document.getElementsByTagName("ons-button")[1].setAttribute("disabled");
      }
    },
    searchLocation() {
      var that = this
      var address = this.geocode;
      var geocoder = new google.maps.Geocoder();

      geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
          that.map.setCenter(results[0].geometry.location);
          that.chosen_location = results[0].geometry.location
          var marker = new google.maps.Marker({
            map: that.resultsMap,
            position: results[0].geometry.location
          });
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    },
    getCurrentLocation() {
      document.getElementById('places').innerHTML = ""
      var that = this
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        that.location = pos
        that.loadMap()
      })
    },
    loadMap() {
      this.current_location = new google.maps.LatLng(this.location.lat, this.location.lng);
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: this.current_location,
        zoom: 15
      });
    },
    loadArea() {
      var service = new google.maps.places.PlacesService(this.map);
      var getNextPage = null;
      var moreButton = document.getElementById('more');
      moreButton.onclick = function() {
        moreButton.disabled = true;
        if (getNextPage) getNextPage();
      };
      var that = this
      var location
      if (this.useCurrentLocation == true)
        location = this.current_location
      else if (this.useCurrentLocation == false)
        location = this.chosen_location

      service.nearbySearch({ location: location, radius: 1000, type: ['bar'], keyword: ['drinks'] },
        function(results, status, pagination) {
          if (status !== 'OK') return;
          that.createMarkers(results);
          moreButton.disabled = !pagination.hasNextPage;
          getNextPage = pagination.hasNextPage && function() {
            pagination.nextPage();
          };
        });
    },
    createMarkers(places) {
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

        var marker = new google.maps.Marker({
          map: this.map,
          icon: image,
          title: place.name,
          position: place.geometry.location
        });

        var li = document.createElement('li');
        li.textContent = place.name;
        placesList.appendChild(li);

        bounds.extend(place.geometry.location);
      }
      this.map.fitBounds(bounds);
    }
  },
}

</script>
<style>
#map {
  height: 400px;
  width: 100%;
}

#places {
  height: 500px;
}

</style>
