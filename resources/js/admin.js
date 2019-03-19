import AdminAreaComponent from './admin/AdminAreaComponent'
import Buefy from 'buefy'
import Vue from 'vue'
import VueRouter from 'vue-router'
import dropZone from 'vue2-dropzone'
import slugify from '@sindresorhus/slugify'

Vue.use(Buefy)
Vue.use(VueRouter)

Vue.component('admin-area', AdminAreaComponent)
Vue.component('drop-zone', dropZone)

Vue.prototype.$slugify = slugify

new Vue({
  el: '#app',
})
