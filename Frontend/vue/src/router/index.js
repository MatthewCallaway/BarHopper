import Vue from 'vue'
import Router from 'vue-router'
import login from '@/components/login'
import home from '@/components/home'
import createaccount from '@/components/createaccount'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'LoginPage',
      component: login
	},
	{
		path: '/createaccount',
		name: 'CreateAccount',
		component: createaccount
	},
	{
		path: '/home',
		name: 'HomePage',
		component: home
	}
]})
