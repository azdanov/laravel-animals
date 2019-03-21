<template>
  <div>
    <section class="hero is-primary is-bold">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Cart Contents
          </h1>
          <p>Check that everything is in order</p>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="columns is-marginless is-centered">
        <div v-if="loading" class="column is-7 mt-5">
          <b-loading
            :is-full-page="true"
            :active.sync="loading"
            :can-cancel="true"
          ></b-loading>
          <p class="subtitle has-text-centered">Loading…</p>
        </div>
        <div v-else-if="Object.entries(cart).length == 0" class="column is-7 mt-5">
          <p class="title has-text-centered">Looks like the cart is empty.</p>
          <p class="subtitle has-text-centered">
            How about some <a href="pets">pet shopping?</a>
          </p>
        </div>
        <div v-else class="column is-7">
          <b-table
            :data="data"
            :columns="columns"
            :selected="selected"
            focusable
            @click="select"
          >
            <template slot="footer">
              <th></th>
              <th></th>
              <th>
                <div class="th-wrap is-numeric">{{ currency(total) }}</div>
              </th>
            </template>
          </b-table>
          <div class="columns mt-4">
            <div class="column is-5">
              <div class="buttons has-addons">
                <button class="button is-outlined" @click="clearCart()">
                  Clear Cart
                </button>
                <button class="button is-outlined" @click="removeItem()">
                  Remove Item
                </button>
              </div>
            </div>
            <div class="column is-3">
              <div class="buttons has-addons is-centered">
                <button class="button is-outlined" @click="changeQuantity(-1)">
                  -
                </button>
                <button class="button is-outlined" @click="changeQuantity(+1)">
                  +
                </button>
              </div>
            </div>
            <div class="column is-clearfix">
              <router-link
                :to="{
                  name: 'payment',
                }"
                class="button is-primary is-pulled-right"
                >Continue</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { currency } from '../helpers'
import api from '../api'

export default {
  name: 'Checkout',
  data() {
    return {
      cart: {},
      selectedId: null,
      total: null,
      quantity: null,
      loading: false,
      columns: [
        {
          field: 'name',
          label: 'Name',
          centered: true,
        },
        {
          field: 'quantity',
          label: 'Quantity',
          centered: true,
        },
        {
          field: 'price',
          label: 'Total',
          numeric: true,
        },
      ],
    }
  },
  computed: {
    data() {
      const array = Object.values(this.cart)

      return array.map(c => ({
        ...c,
        quantity: `${c.quantity} ⨉ ${this.currency(c.price)}`,
        price: this.currency(c.quantity * c.price),
      }))
    },
    selected() {
      if (this.selectedId == null) return null

      return this.data.filter(({ id }) => id == this.selectedId).pop()
    },
    cartItem() {
      if (this.selectedId == null) return null

      return Object.values(this.cart)
        .filter(({ id }) => id == this.selectedId)
        .pop()
    },
  },
  async mounted() {
    let cart
    this.loading = true
    try {
      cart = await api.get('cart').json()
    } catch (e) {
      return (this.loading = false)
    }

    this.loading = false
    this.assignCart(cart)
  },
  methods: {
    currency,
    updateNavbar() {
      document.querySelector('#navbar-cart').textContent =
        this.cart.length > 0 ? `Cart (${this.cart.length})` : 'Cart'
    },
    select(row) {
      if (this.selectedId == row.id) {
        this.selectedId = null
      } else {
        this.selectedId = row.id
      }
    },
    assignCart(cart) {
      if (cart == null) return

      this.total = cart.total
      this.quantity = cart.quantity
      delete cart.total
      delete cart.quantity

      this.cart = Object.assign({}, this.cart, cart)
    },
    async changeQuantity(amount) {
      if (this.selectedId == null || (amount < 0 && this.cartItem.quantity <= 1)) {
        return
      }

      const cart = await api
        .patch(`cart/${this.selected.id}`, {
          json: { quantity: amount },
        })
        .json()

      this.assignCart(cart)
    },
    async removeItem() {
      if (this.selectedId == null) {
        return
      }

      let cart
      try {
        cart = await api.delete(`cart/${this.selected.id}`).json()
      } catch (e) {
        this.$toast.open({
          message: 'Cart is empty.',
          type: 'is-primary',
          position: 'is-bottom',
        })
      }

      this.$toast.open({
        message: `${this.cartItem.name} was deleted.`,
        type: 'is-primary',
        position: 'is-bottom',
      })

      this.$delete(this.cart, this.selectedId)
      this.updateNavbar()

      this.assignCart(cart)
    },
    async clearCart() {
      await api.delete(`cart/clear`)

      this.cart = {}

      this.$toast.open({
        message: 'Cart is empty.',
        type: 'is-primary',
        position: 'is-bottom',
      })
      this.updateNavbar()
    },
  },
}
</script>

<style lang="scss">
.table {
  font-variant-numeric: tabular-nums;
}
tr.table-footer {
  font-weight: bold;
}

.b-table .table:focus {
  border-color: hsl(256, 60%, 59%);
  outline: none;
}
</style>
