<template>
  <aside class="menu">
    <p class="menu-label">
      Categories
    </p>
    <ul class="menu-list">
      <li v-for="category of categories" :key="category.id">
        <router-link
          :to="{ name: 'category', params: { slug: slugify(category.name) } }"
          >{{ category.name }}</router-link
        >
      </li>
    </ul>
  </aside>
</template>

<script>
import slugify from '@sindresorhus/slugify'

export default {
  name: 'CategoryList',
  computed: {
    categories() {
      return this.$store.state.categories
    },
  },
  methods: {
    slugify,
  },
}
</script>

<style scoped></style>
