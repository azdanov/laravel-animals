<template>
  <router-view></router-view>
</template>

<script>
import Checkout from './Checkout'
import Payment from './Payment'
import VueRouter from 'vue-router'

export default {
  name: 'CheckoutAreaComponent',
  router: new VueRouter({
    mode: 'history',
    base: 'cart',
    routes: [
      {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
      },
      {
        path: '/',
        redirect: { name: 'checkout' },
      },
      {
        path: '/payment',
        name: 'payment',
        component: Payment,
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
