<template>
  <article v-if="pet" class="media">
    <figure class="media-left">
      <p class="image is-128x128">
        <img class="has-round-corners" :src="'/images/' + pet.image" :alt="pet.name" />
      </p>
    </figure>
    <div class="media-content">
      <div class="content">
        <div>
          <strong>{{ pet.name }}</strong
          ><small class="has-left-dash">{{ currency(pet.price) }}</small>
          <br />
          <p>{{ pet.description }}</p>
          <b-tag>
            <router-link
              :to="{
                name: 'categories-one',
                params: { slug: $slugify(pet.category.name) },
              }"
              >{{ pet.category.name }}</router-link
            ></b-tag
          >
        </div>
      </div>
      <nav class="level is-mobile mt-4">
        <div class="level-left">
          <button class="level-item button is-outlined" @click="editCategory(pet.id)">
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
    currency: new Intl.NumberFormat('et', {
      style: 'currency',
      currency: 'EUR',
    }).format,
    deletePet(id) {
      if (confirm(`Delete ${this.pet.name} from ${this.pet.category.name}?`)) {
        this.$store.dispatch('deletePet', id).then(() => {
          this.$router.push('/pets')
        })
      }
    },
    editCategory() {
      this.$router.push(`/pets/${this.$slugify(this.pet.name)}/edit`)
    },
  },
}
</script>

<style scoped></style>
