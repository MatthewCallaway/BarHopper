<template>
  <div>
    <v-ons-toolbar>
      <div class="center">Home</div>
      <div class="left">
        <v-ons-button modifier="quiet" @click="logoutUser()">Logout</v-ons-button>
      </div>
    </v-ons-toolbar>
    <google-map></google-map>
  </div>
</template>
<script>
import GoogleMap from './google_map'

export default {
  data() {
    return {

    }
  },
  methods: {
    logoutUser() {
      sessionStorage.clear()
      this.$router.push('/')
      location.reload()
    },
  },
  components: {
    GoogleMap
  },
  mounted: function() {
    if (this.$store.state.user == null) {
      this.$router.push('/')
      alert('Please Log In')
    }
  }
}

</script>
