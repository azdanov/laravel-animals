import Vue from 'vue'
import '../images/animals.svg'
import '../images/cat.svg'
import '../images/dog.svg'
import '../images/bird.svg'
import '../images/catdog.jpg'
import './api'
import ExampleComponent from './components/ExampleComponent'

Vue.component('example-component', ExampleComponent)

new Vue({
  el: '#app',
})
