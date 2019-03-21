<template>
  <router-view></router-view>
</template>

<script>
import Checkout from './Cart'
import Orders from './Orders'
import Payment from './Payment'
import VueRouter from 'vue-router'
import api from '../api'

export default {
  name: 'UserAreaComponent',
  router: new VueRouter({
    mode: 'history',
    base: 'user',
    routes: [
      {
        path: '/cart',
        name: 'cart',
        component: Checkout,
      },
      {
        path: '/',
        redirect: { name: 'cart' },
      },
      {
        path: '/payment',
        name: 'payment',
        component: Payment,
        beforeEnter: async (to, from, next) => {
          const quantity = await api.get('cart/quantity').text()

          if (quantity > 0) next()
          else next('/')
        },
      },
      {
        path: '/orders',
        name: 'orders',
        component: Orders,
      },
      {
        path: '*',
        redirect: '/',
      },
    ],
  }),
}
</script>

<style lang="scss"></style>
