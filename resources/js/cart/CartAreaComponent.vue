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
        <div class="column is-7">
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
                <button class="button is-outlined">Clear Cart</button>
                <button class="button is-outlined">Remove Item</button>
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
              <button class="button is-primary is-pulled-right">Continue</button>
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
  name: 'CartAreaComponent',
  data() {
    return {
      cart: {},
      selectedId: null,
      total: null,
      quantity: null,
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
      return this.data.filter(({ id }) => id == this.selectedId).pop()
    },
    cartItem() {
      return Object.values(this.cart)
        .filter(({ id }) => id == this.selectedId)
        .pop()
    },
  },
  async mounted() {
    const cart = await api.get('cart').json()

    this.assignCart(cart)
  },
  methods: {
    currency,
    select(row) {
      this.selectedId = row.id
    },
    assignCart(cart) {
      this.total = cart.total
      this.quantity = cart.quantity
      delete cart.total
      delete cart.quantity

      this.cart = Object.assign({}, this.cart, cart)
    },
    async changeQuantity(amount) {
      if (amount < 0 && this.cartItem.quantity <= 1) {
        return
      }

      const cart = await api
        .patch(`cart/${this.selected.id}`, {
          json: { quantity: amount },
        })
        .json()

      this.assignCart(cart)
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
