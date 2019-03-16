import './api'
import AdminAreaComponent from './components/AdminAreaComponent'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.component('admin-area', AdminAreaComponent)

Vue.use(VueRouter)

new Vue({
  el: '#app',
})
