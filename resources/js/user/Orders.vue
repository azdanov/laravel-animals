<template>
  <div>
    <section class="hero is-info is-bold">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Orders
          </h1>
          <p>Your history with us</p>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="columns is-marginless is-centered">
        <div class="column is-7 mt-5">
          <b-loading :active.sync="loading" :can-cancel="true"></b-loading>
          <p v-if="loading" class="subtitle has-text-centered">Loading…</p>
          <div v-else-if="!loading && orders.length == 0">
            <p class="title has-text-centered">Looks like there are no orders.</p>
            <p class="subtitle has-text-centered">
              How about some <a href="/pets">pet shopping?</a>
            </p>
          </div>
          <b-table v-else :data="orders" paginated per-page="3" default-sort="date">
            <template slot-scope="props">
              <b-table-column field="id" label="Order ID" sortable centered>
                {{ props.row.id }}
              </b-table-column>

              <b-table-column field="name" label="Name" sortable>
                {{ props.row.name }}
              </b-table-column>

              <b-table-column field="quantity" label="Quantity" sortable centered>
                {{ props.row.quantity }}
              </b-table-column>

              <b-table-column field="price" label="Price" sortable numeric>
                {{ currency(props.row.price) }}
              </b-table-column>

              <b-table-column field="date" label="Date" sortable centered>
                <span class="tag">
                  {{
                    new Date(props.row.created_at).toLocaleDateString('en', {
                      year: 'numeric',
                      month: 'short',
                      day: 'numeric',
                    })
                  }}
                </span>
              </b-table-column>
            </template>
          </b-table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { currency } from '../helpers'
import api from '../api'

export default {
  name: 'Orders',
  data() {
    return {
      orders: [],
      loading: true,
    }
  },
  async mounted() {
    const res = await api.get('orders').json()

    this.loading = false

    res.forEach(order => this.orders.push(order))
  },
  methods: {
    currency,
  },
}
</script>

<style></style>
