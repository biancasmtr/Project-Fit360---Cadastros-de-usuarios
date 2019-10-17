import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './views/Login'
import Signup from './views/Signup'
import Home from './views/Home'
import ContatoDetalhes from './views/contatos/ContatoDetalhes'
import ContatosHome from './views/contatos/ContatosHome'

Vue.use(VueRouter)

export default new VueRouter ({
  mode: 'history',
  routes: [
  { path: '/', component: Login },
  { path: '/login', component: Login },
  { path: '/signup', component: Signup },

  { 
    path: '/home',
    component: Home, 
    children: [
      { path: ':id', component: ContatoDetalhes, name: 'contato'},
      { path: '', component: ContatosHome }
  ]},


  ]
})