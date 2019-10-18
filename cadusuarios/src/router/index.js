import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Login.vue'
import Signup from '../views/Signup.vue'
import Home from '../views/Home.vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

Vue.use(VueRouter)

export default new VueRouter ({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/signup',
      name: 'Signup',
      component: Signup
    },
    {
      path: '/home',
      name: 'Home',
      component: Home
  }
  ]
})
