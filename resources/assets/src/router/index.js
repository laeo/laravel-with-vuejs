import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/views/HelloWorld'
import Auth from '@/views/Auth'
import Home from '@/views/Home'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/auth',
      name: 'Auth',
      component: Auth
    },
    {
      path: '/home',
      name: 'Home',
      component: Home
    }
  ]
})
