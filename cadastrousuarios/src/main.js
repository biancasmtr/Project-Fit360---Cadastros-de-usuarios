import Vue from 'vue'
import App from './App.vue'
import Login from './views/Login';
import Home from './views/Home';
import SingUp from './views/SingUp'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')


const routes = [
  { path: '/login', component: Login },
  { path: '/home', component: Home },
  { path: '/singup', component: SingUp },
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

