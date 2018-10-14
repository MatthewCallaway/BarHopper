<template>
  <div id="main-page">
    <div class="loginbox" style="overflow: scroll">
      <h1 id="mainTitle">BarHopper</h1>
      <!-- <img src="avatar.png" class="avatar"> -->
      <h1>Login Here</h1>
      <p>Username</p>
      <input v-model="name" type="text" name="" placeholder="Enter Username">
      <p>Password</p>
      <input v-model="pass" type="password" name="" placeholder="Enter Password">
      <input @click="loadData()" type="submit" name="" value="Login">
      <button @click="test()">TEST DATA</button>
      <button id="more">again</button>
      <a href="#">Lost your password?</a><br>
      <a href="#">Don't have an account?</a>
      <div id="map">
      </div>
      <button @click="test1()">More</button>
      <div id="places">
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: '',
      pass: '',
      map: null,
      pyrmont: null
    }
  },
  methods: {
    loadData() {
      this.$http.post('http://127.0.0.1:8000/api/loadData').then(response => {
        console.log(response.data)
      })
    },
    test1() {
      this.pyrmont = new google.maps.LatLng(38.9511, -92.3266);
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: this.pyrmont,
        zoom: 15
      });
    },
    test() {
      // gapi.client.init({
      //   'apiKey': 'AIzaSyAy6h-EOS_JtZoLTrmFSHzy5A66Ew6712s',
      // }).then(function() {
      //   return gapi.client.request({
      //   'path': 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=38.9511,-92.3266&radius=10000&type=bar&keyword=drinks',
      //   // 'path': 'https://people.googleapis.com/v1/people/me?requestMask.includeField=person.names',
      //   })
      // })


      var service = new google.maps.places.PlacesService(this.map);
      var getNextPage = null;
      var moreButton = document.getElementById('more');
      moreButton.onclick = function() {
        moreButton.disabled = true;
        if (getNextPage) getNextPage();
      };
      var that = this

      // Perform a nearby search.
      service.nearbySearch({ location: this.pyrmont, radius: 1000, type: ['bar'], keyword:['drinks'] },
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
  mounted: function() {
  }
}

</script>
<style>
@-ms-viewport {
  width: device-width;
  height: device-height;
}

body {
  margin: 0;
  padding: 0;
  /*background: url(logo.png);*/
  background-size: cover;
  background-position: center;
  font-family: sans-serif;
}

#mainTitle {
  font-size: 500%;
  padding-top: 15%;
  padding-bottom: 5%;
}

@media screen and (max-width: 415px) {
  #mainTitle {
    padding-bottom: 5%;
    font-size: 300%;
  }
}

.loginbox {
  width: 100%;
  height: 100%;
  background: #000;
  color: #ffc107;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
  box-sizing: border-box;
  padding: 2% 5%;
}

h1 {
  margin: 0;
  padding: 0 0 2%;
  text-align: center;
  font-size: 100%;
}

.loginbox p {
  margin: 0;
  padding: 0;
  font-weight: bold;
}

.loginbox input {
  width: 100%;
  margin-bottom: 2%;
}

.loginbox input[type="text"],
input[type="password"] {
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 5%;
  color: #fff;
  font-size: 100%;
}

.loginbox input[type="submit"] {
  border: none;
  outline: none;
  height: 5%;
  background: #ffc107;
  color: #ffc107;
  font-size: 100%;
}

.loginbox input[type="submit"] {
  cursor: pointer;
  background: #ffc107;
  color: #000;
}

.loginbox a {
  text-decoration: none;
  font-size: 100%;
  line-height: 200%;
  color: darkgrey;
}

.loginbox a:hover {
  color: #ffc107;
}

#map {
  height: 400px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}

#places{
	height: 500px;
}

</style>
