import AdminAreaComponent from './cart/CartAreaComponent'
import Buefy from 'buefy'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(Buefy)
Vue.use(VueRouter)

Vue.component('cart-area', AdminAreaComponent)

new Vue({
  el: '#app',
})
