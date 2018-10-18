// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueOnsen from 'vue-onsenui'; // This imports 'onsenui', so no need to import it separately
import VueResource from 'vue-resource'
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import 'onsenui/css/onsenui.css';
import 'onsenui/css/onsen-css-components.css';


Vue.use(VueResource)
Vue.use(VueOnsen)
Vue.use(Vuex)
Vue.config.productionTip = false

const store = new Vuex.Store({
  state: {
    user: null
  },
  plugins: [createPersistedState({
    storage: window.sessionStorage,
  })],
  mutations: {
    SET_USER(state, obj) {
      state.user = obj
    }
  },
  actions: {
    setUser({ commit }, obj) {
      return new Promise((resolve, reject) => {
        commit('SET_USER', obj)
        resolve('user-set')
      })
    }
  }
});


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})


