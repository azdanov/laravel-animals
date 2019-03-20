<template>
  <div>
    <section class="hero is-info is-bold">
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
              <li :class="{ 'is-active': isActive('categories') }">
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
import CategoryList from './CategoryList'
import CategoryModify from './CategoryModify'
import Choose from './Choose'
import Pet from './Pet'
import PetList from './PetList'
import PetModify from './PetModify'
import VueRouter from 'vue-router'
import store from '../store/admin'

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
        path: '/categories/add',
        name: 'categories-add',
        components: {
          default: CategoryList,
          main: CategoryModify,
        },
      },
      {
        path: '/categories/:slug',
        name: 'categories-one',
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
        name: 'categories-edit',
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
        path: '/pets',
        name: 'pets',
        components: {
          default: PetList,
          main: Choose,
        },
      },
      {
        path: '/pets/add',
        name: 'pets-add',
        components: {
          default: PetList,
          main: PetModify,
        },
      },
      {
        path: '/pets/:slug',
        name: 'pets-one',
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
        path: '/pets/:slug/edit',
        name: 'pets-edit',
        components: {
          default: PetList,
          main: PetModify,
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

<style lang="scss">
@import '~vue2-dropzone/dist/vue2Dropzone.min.css';

.dropzone {
  border-radius: 4px;
  background-color: hsl(0, 0%, 100%);
  border: 1px solid hsl(0, 0%, 86%);
  color: hsl(0, 0%, 76%);
  box-shadow: inset 0 1px 2px rgba(10, 10, 10, 0.1);
  max-width: 100%;
  width: 100%;
  padding: 0.625em;
  min-height: 100px;

  &:hover {
    cursor: pointer;
    border-color: hsl(0, 0%, 71%);
  }

  &.is-danger {
    border-color: hsl(348, 100%, 61%);
  }

  .dz-message {
    margin: 0;
  }

  .dz-preview {
    margin: 0;
    .dz-image {
      border-radius: 4px;
    }
  }
}

.vue-dropzone {
  transition: none;

  &:hover {
    background-color: hsl(0, 0%, 100%);
  }

  & > .dz-preview .dz-details {
    background-color: hsl(263, 64%, 70%);
  }
}
</style>
