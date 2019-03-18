<template>
  <aside class="menu">
    <p class="menu-label">
      Add
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'categories-add' }">New Category</router-link>
      </li>
    </ul>
    <p class="menu-label">
      Categories
    </p>
    <ul class="menu-list">
      <li v-for="category of categories" :key="category.id">
        <router-link
          :to="{ name: 'categories-one', params: { slug: $slugify(category.name) } }"
          >{{ category.name }}</router-link
        >
      </li>
    </ul>
  </aside>
</template>

<script>
export default {
  name: 'CategoryList',
  computed: {
    categories() {
      return this.$store.state.categories
    },
  },
}
</script>

<style scoped></style>
