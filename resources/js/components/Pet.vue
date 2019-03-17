<template>
  <article v-if="pet" class="media">
    <figure class="media-left">
      <p class="image is-128x128">
        <img class="has-round-corners" :src="'/images/' + pet.image" :alt="pet.name" />
      </p>
    </figure>
    <div class="media-content">
      <div class="content">
        <p>
          <strong>{{ pet.name }}</strong
          ><small class="has-left-dash">{{ currency(pet.price) }}</small>
          <br />
          {{ pet.description }}
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <button class="level-item button is-outlined">
            <span class="icon">
              <span class="icon-edit"></span>
            </span>
            <span>Edit</span>
          </button>
          <button class="level-item button is-outlined" @click="deletePet(pet.id)">
            <span class="icon">
              <span class="icon-trash-o"></span>
            </span>
            <span>Delete</span>
          </button>
        </div>
      </nav>
    </div>
  </article>
</template>

<script>
export default {
  name: 'Pet',
  props: { slug: { type: String, default: null } },
  computed: {
    pet() {
      return this.$store.getters.pet(this.slug)
    },
  },
  methods: {
    currency(value) {
      return new Intl.NumberFormat('et', {
        style: 'currency',
        currency: 'EUR',
      }).format(value / 100)
    },
    deletePet(id) {
      if (confirm(`Delete ${this.pet.name} from ${this.pet.category.name}?`)) {
        this.$store.dispatch('deletePet', id).then(() => {
          this.$router.push('/pets')
        })
      }
    },
  },
}
</script>

<style scoped></style>
