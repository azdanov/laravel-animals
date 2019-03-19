<template>
  <div>
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
          <b-taglist>
            <b-tag v-for="pet of pets" :key="pet.id">
              <router-link
                :to="{ name: 'pets-one', params: { slug: $slugify(pet.name) } }"
                >{{ pet.name }}</router-link
              ></b-tag
            >
          </b-taglist>
        </div>
        <nav class="level is-mobile mt-4">
          <div class="level-left">
            <button class="level-item button is-outlined" @click="editCategory()">
              <b-icon custom-class="icon-edit"></b-icon>
              <span>Edit</span>
            </button>
            <button
              class="level-item button is-outlined"
              @click="deleteCategory(category.id)"
            >
              <b-icon custom-class="icon-trash-o"></b-icon>
              <span>Delete</span>
            </button>
          </div>
        </nav>
      </div>
    </article>
  </div>
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
      return this.$store.getters.pets.filter(
        pet => pet.category.name === this.category.name,
      )
    },
  },
  methods: {
    deleteCategory(id) {
      if (
        confirm(`Delete ${this.category.name} that contains ${this.pets.length} items?`)
      ) {
        this.$store.dispatch('deleteCategory', id).then(() => {
          this.$router.push('/categories', () => {
            this.$toast.open({
              message: `${this.category.name} has been deleted.`,
              type: 'is-warning',
              position: 'is-bottom',
            })
          })
        })
      }
    },
    editCategory() {
      this.$router.push(`/categories/${this.$slugify(this.category.name)}/edit`)
    },
  },
}
</script>

<style scoped></style>
