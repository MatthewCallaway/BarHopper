<template>
  <div>
    <div class="loginbox" style="overflow: scroll">
      <h1 id="mainTitle">BarHopper</h1>
      <p>Username</p>
      <input v-model="name" type="text" name="" placeholder="Enter Username">
      <p>Password</p>
      <input v-model="pass" type="password" name="" placeholder="Enter Password">
      <input @click="loginUser()" type="submit" name="" value="Login">
      <a href="#/createaccount">Want to create an account?</a>
    </div>
  </div>
</template>
<script>
import {loginUser} from '../router/config'

export default {
  data() {
    return {
      name: '',
      pass: ''
    }
  },
  methods: {
    loginUser() {
      var postData = {
        username: this.name,
        pass: this.pass
      }
      console.log(postData)
      this.$http.post(loginUser, postData).then(response => {
        if (response.data == 500)
          alert('Login Failed')
        else {
          var userCreds = {
            id: response.data.id,
            username: response.data.username,
            firstname: response.data.firstname,
            lastname: response.data.lastname
          }
          this.$store.dispatch('setUser', userCreds).then(response => {
            this.$router.push('/home')
          })
        }
      })
    },
  },
  mounted: function() {}
}

</script>
<style>
@-ms-viewport {
  width: device-width;
  height: device-height;
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

</style>
