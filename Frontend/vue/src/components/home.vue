<template>
  <div>
    <button @click="logoutUser()">Logout</button>
    <google-map></google-map>
  </div>
</template>

<script>
import GoogleMap from './google_map'

  export default{
    data(){
      return{

      }
    },
    methods: {
      logoutUser(){
        sessionStorage.clear()
        this.$router.push('/')
      }
    },
    components:{
      GoogleMap
    },
    mounted: function(){
      if(this.$store.state.user == null){
        this.$router.push('/')
        alert('Please Log In')
      }
    }
  }
</script>