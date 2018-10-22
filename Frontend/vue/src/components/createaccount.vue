<template id="main">
  <div>
    <v-ons-page>
      <v-ons-toolbar>
        <div class="left">
          <v-ons-button modifier="quiet" @click="$router.push('/')">Back</v-ons-button>
        </div>
        <div class="center">Create An Account</div>
      </v-ons-toolbar>
      <v-ons-list>
        <v-ons-list-item v-for="option in options" :key="option.id">
          <div class="center">
            <v-ons-input :placeholder="option.placeholder" :type="option.type" :id="option.model">
            </v-ons-input>
          </div>
        </v-ons-list-item>
        <v-ons-list-item>
          <span style="font-size: 16px; color: #999999;">Birthday: </span><input style="font-size: 16px;" type="date" v-model="birthday"> </input>
        </v-ons-list-item>
        <v-ons-list-item>
          <span style="font-size: 16px; color: #999999;">Gender: </span>
          <select v-model="gender" style="font-size: 16px;">
            <option>Male</option>
            <option>Female</option>
          </select>
        </v-ons-list-item>
      </v-ons-list>
      <section style="margin: 10px;">
        <v-ons-button modifier="large" style="margin: 6px 0; background: goldenrod;" @click="registerUser()">Submit</v-ons-button>
        <v-ons-progress-bar indeterminate v-show="isLoading"></v-ons-progress-bar>
      </section>
    </v-ons-page>
  </div>
</template>
<script>
import {registerUser} from '../router/config'

export default {
  data() {
    return {
      isLoading: false,
      gender: '',
      birthday: '',
      options: [
        { placeholder: 'Firstname...', type: 'text', model: 'firstName' },
        { placeholder: 'Lastname...', type: 'text', model: 'lastName' },
        { placeholder: 'Username...', type: 'text', model: 'username' },
        { placeholder: 'Password...', type: 'password', model: 'pass' },
        { placeholder: 'Email...', type: 'text', model: 'email' }
      ],
    }
  },
  methods: {
    registerUser() {
      this.isLoading = true;
      console.log(document.getElementById('firstName').value)
      var postData = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        pass: document.getElementById('pass').value,
        username: document.getElementById('username').value,
        gender: this.gender,
        birthday: this.birthday
      }
      this.$http.post(registerUser, postData).then(response => {
        this.isLoading = false;
        alert('Account Created')
        this.$router.push('/')
      })
    },

  }
}

</script>
