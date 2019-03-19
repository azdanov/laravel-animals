import Buefy from 'buefy'
import CheckoutAreaComponent from './checkout/CheckoutAreaComponent'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(Buefy)
Vue.use(VueRouter)

Vue.component('checkout-area', CheckoutAreaComponent)

new Vue({
  el: '#app',
})
