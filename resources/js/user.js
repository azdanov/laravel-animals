import Buefy from 'buefy'
import CheckoutAreaComponent from './user/UserAreaComponent'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(Buefy)
Vue.use(VueRouter)

Vue.component('user-area', CheckoutAreaComponent)

new Vue({
  el: '#app',
})
