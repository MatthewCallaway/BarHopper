import Vue from 'vue'
import Router from 'vue-router'
import home from '@/components/home'
import createaccount from '@/components/createaccount'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HomePage',
      component: home
	},
	{
		path: '/createaccount',
		name: 'CreateAccount',
		component: createaccount
	}
]})
