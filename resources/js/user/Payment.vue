<template>
  <div>
    <section class="hero is-primary is-bold">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title">
            Payment
          </h1>
          <p>One last step</p>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="columns is-marginless is-centered">
        <div class="column is-7 mt-5">
          <b-loading
            :active.sync="loading"
            :can-cancel="true"
            :is-full-page="true"
          ></b-loading>
          <form class="is-clearfix" @submit.prevent="proceed()">
            <div ref="dropin" class="mb-4"></div>
            <small v-show="!loading && !nonce" class="is-unselectable"
              >Demo Card Number:</small
            >
            <small v-show="!loading && !nonce">4005 5192 0000 0004</small>
            <button
              v-show="!loading && !nonce"
              :class="['button', 'is-primary', 'is-outlined', 'is-pulled-right']"
              type="submit"
            >
              Verify
            </button>
            <button
              v-show="!loading && nonce"
              :class="['button', 'is-primary', 'is-outlined', 'is-pulled-right']"
              type="submit"
            >
              Complete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../api'
import braintree from 'braintree-web-drop-in'

export default {
  data() {
    return {
      loading: true,
      dropinInstance: null,
      nonce: null,
    }
  },
  async mounted() {
    const { token } = await api.get('braintree/token').json()

    braintree.create(
      {
        authorization: token,
        container: this.$refs.dropin,
      },
      (err, instance) => {
        this.loading = false

        if (err) {
          this.$toast.open({
            message: `There was an error setting up the client instance. Message: ${
              err.message
            }`,
            type: 'is-danger',
            position: 'is-bottom',
          })
          return
        }

        this.dropinInstance = instance
      },
    )
  },
  methods: {
    proceed() {
      if (!this.nonce) {
        return this.verify()
      }

      this.submit()
    },
    async verify() {
      this.dropinRequestPaymentMethod()
    },
    submit() {
      this.$toast.open({
        message: 'Waiting for a response…',
        type: 'is-info',
        position: 'is-bottom',
      })

      api
        .post('cart/payment', { json: { nonce: this.nonce } })
        .then(res => res.json())
        .then(({ error = '', message = '' }) => {
          if (error) {
            return this.$toast.open({
              message: error,
              type: 'is-danger',
              position: 'is-bottom',
            })
          }

          this.$router.push('orders', () => {
            document.querySelector('#navbar-cart').textContent = 'Cart'

            this.$toast.open({
              message: message,
              type: 'is-success',
              position: 'is-bottom',
            })
          })
        })
        .catch(console.log)
    },
    dropinRequestPaymentMethod() {
      this.dropinInstance.requestPaymentMethod((err, payload) => {
        if (err) {
          this.$toast.open({
            message: `There was an error setting up the client instance. Message: ${
              err.message
            }`,
            type: 'is-danger',
            position: 'is-bottom',
          })
          return
        }
        this.nonce = payload.nonce
      })
    },
  },
}
</script>

<style>
#dropin {
  margin-bottom: 20px;
}
</style>
