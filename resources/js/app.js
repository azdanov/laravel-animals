import Vue from 'vue'
import './bootstrap'
import './api'
import ExampleComponent from './components/ExampleComponent'

Vue.component('example-component', ExampleComponent)

new Vue({
  el: '#app',
})
