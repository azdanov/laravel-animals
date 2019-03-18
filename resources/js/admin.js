import './api'
import AdminAreaComponent from './components/AdminAreaComponent'
import Buefy from 'buefy'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(Buefy)

Vue.component('admin-area', AdminAreaComponent)

Vue.use(VueRouter)

new Vue({
  el: '#app',
})
