<template>
  <aside class="menu">
    <p class="menu-label">
      Add
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'pet-add' }">New Pet</router-link>
      </li>
    </ul>
    <template v-for="(group, key) in petGroups">
      <p :key="key + 'p'" class="menu-label">
        {{ key }}
      </p>
      <ul :key="key + 'ul'" class="menu-list">
        <li v-for="pet of group" :key="pet.id">
          <router-link :to="{ name: 'pet', params: { slug: slugify(pet.name) } }">{{
            pet.name
          }}</router-link>
        </li>
      </ul>
    </template>
  </aside>
</template>

<script>
import { mapState } from 'vuex'
import slugify from '@sindresorhus/slugify'

export default {
  name: 'PetList',
  computed: mapState(['petGroups']),
  methods: {
    slugify,
  },
}
</script>

<style scoped></style>
