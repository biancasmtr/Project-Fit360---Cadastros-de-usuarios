import Vue from 'vue'
import Router from 'vue-router'

import Login from './views/Login';
import Home from './views/Home';
import SingUp from './views/SingUp'

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
        path: '/',
        name: 'Login',
        component: Login
        },
        {
        path: '/home',
        name: 'Home',
        component: Home
        },
        {
        path: '/singup',
        name: 'SingUp',
        component: SingUp
        },
    ]
})