<template>
  <div>
    <section class="hero is-primary is-bold">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Admin Area
          </h1>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="columns is-marginless is-centered">
        <div class="column">
          <div class="tabs">
            <ul>
              <li :class="{ 'is-active': isActive('categ') }">
                <router-link :to="{ name: 'categories' }">Categories</router-link>
              </li>
              <li :class="{ 'is-active': isActive('pets') }">
                <router-link :to="{ name: 'pets' }">Pets</router-link>
              </li>
            </ul>
          </div>
          <div class="columns is-mobile">
            <div class="column is-one-quarter-mobile is-one-fifth-tablet">
              <router-view></router-view>
            </div>
            <div class="column is-two-thirds-desktop">
              <router-view :key="$route.fullPath" name="main"></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Category from './Category'
import CategoryModify from './CategoryModify'
import CategoryList from './CategoryList'
import Choose from './Choose'
import Pet from './Pet'
import PetAdd from './PetAdd'
import PetList from './PetList'
import VueRouter from 'vue-router'
import store from '../store'
// import 'buefy/dist/buefy.css'

export default {
  store,
  router: new VueRouter({
    mode: 'history',
    base: 'admin',
    linkActiveClass: 'is-active',
    routes: [
      {
        path: '/categories',
        name: 'categories',
        components: {
          default: CategoryList,
          main: Choose,
        },
      },
      {
        path: '/',
        redirect: { name: 'categories' },
      },
      {
        path: '/pets',
        name: 'pets',
        components: {
          default: PetList,
          main: Choose,
        },
      },
      {
        path: '/categories/add',
        name: 'category-add',
        components: {
          default: CategoryList,
          main: CategoryModify,
        },
      },
      {
        path: '/categories/:slug',
        name: 'category',
        components: {
          default: CategoryList,
          main: Category,
        },
        props: {
          default: false,
          main: true,
        },
      },
      {
        path: '/categories/:slug/edit',
        name: 'category-edit',
        components: {
          default: CategoryList,
          main: CategoryModify,
        },
        props: {
          default: false,
          main: true,
        },
      },
      {
        path: '/pets/add',
        name: 'pet-add',
        components: {
          default: PetList,
          main: PetAdd,
        },
      },
      {
        path: '/pets/:slug',
        name: 'pet',
        components: {
          default: PetList,
          main: Pet,
        },
        props: {
          default: false,
          main: true,
        },
      },
      {
        path: '*',
        redirect: '/',
      },
    ],
  }),
  mounted() {
    this.$store.dispatch('fetchAll')
  },
  methods: {
    isActive(name) {
      return name.includes(this.$route.name) || this.$route.name.includes(name)
    },
  },
}
</script>
