<template>
  <article v-if="category" class="media">
    <figure class="media-left">
      <p class="image is-128x128">
        <img
          class="has-round-corners"
          :src="'/images/' + category.image"
          :alt="category.name"
        />
      </p>
    </figure>
    <div class="media-content">
      <div class="content">
        <p>
          <strong>{{ category.name }}</strong>
          <br />
          {{ category.description }}
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <button class="level-item button is-outlined">
            <span class="icon"><span class="icon-edit"></span></span>
            <span>Edit</span>
          </button>
          <button
            class="level-item button is-outlined"
            @click="deleteCategory(category.id)"
          >
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
  name: 'Category',
  props: { slug: { type: String, default: null } },
  computed: {
    category() {
      return this.$store.getters.category(this.slug)
    },
    pets() {
      return this.$store.getters.pets
    },
  },
  methods: {
    deleteCategory(id) {
      const pets = this.pets.filter(pet => pet.category.name === this.category.name)

      if (confirm(`Delete ${this.category.name} that contains ${pets.length} items?`)) {
        this.$store.dispatch('deleteCategory', id).then(() => {
          this.$router.push('/categories')
        })
      }
    },
  },
}
</script>

<style scoped></style>
