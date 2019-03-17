import Vue from 'vue'
import Vuex from 'vuex'
import api from '../api'
import slugify from '@sindresorhus/slugify'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    categories: [],
    petGroups: {},
  },
  mutations: {
    SET_CATEGORIES(state, categories) {
      state.categories = categories
    },
    SET_PET_GROUPS(state, petGroups) {
      state.petGroups = petGroups
    },
  },
  actions: {
    async fetchCategories({ commit }) {
      const categories = await api.get('categories').json()
      commit('SET_CATEGORIES', categories)
    },
    async fetchPetGroups({ commit }) {
      const petGroups = await api.get('pets').json()
      commit('SET_PET_GROUPS', petGroups)
    },
    async fetchAll({ dispatch }) {
      Promise.all([dispatch('fetchCategories'), dispatch('fetchPetGroups')])
    },
    async deletePet({ dispatch }, id) {
      await api.delete(`pets/${id}`)

      dispatch('fetchPetGroups')
    },
    async deleteCategory({ dispatch }, id) {
      await api.delete(`categories/${id}`)

      dispatch('fetchAll')
    },
  },
  getters: {
    pets(state) {
      return Object.values(state.petGroups).flat()
    },
    pet: (state, getters) => slug => {
      return getters.pets.filter(pet => slugify(pet.name) === slug).pop()
    },
    category: state => slug => {
      return state.categories.filter(category => slugify(category.name) === slug).pop()
    },
  },
})
