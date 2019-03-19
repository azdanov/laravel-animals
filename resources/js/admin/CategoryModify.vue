<template>
  <form @submit.prevent="submit">
    <b-field
      horizontal
      label="Name"
      label-for="name"
      :type="errors.name ? 'is-danger' : ''"
      :message="errors.name[0]"
    >
      <b-input
        id="name"
        v-model="form.name"
        name="name"
        placeholder="Category name"
        required
        expanded
        @blur="errors.name = ''"
      ></b-input>
    </b-field>

    <b-field
      horizontal
      label="Description"
      label-for="description"
      :type="errors.description ? 'is-danger' : ''"
      :message="errors.description[0]"
    >
      <b-input
        id="description"
        v-model="form.description"
        name="description"
        placeholder="Description for this category"
        required
        expanded
        type="textarea"
        @blur="errors.description = ''"
      ></b-input>
    </b-field>

    <b-field
      horizontal
      label="Display Order"
      label-for="display_order"
      :type="errors.display_order ? 'is-danger' : ''"
      :message="errors.display_order[0]"
    >
      <b-input
        id="display_order"
        v-model="form.display_order"
        name="display_order"
        placeholder="Order of this category"
        required
        expanded
        type="number"
        min="1"
        @blur="errors.display_order = ''"
      ></b-input>
    </b-field>

    <b-field
      horizontal
      label="Image"
      label-for="image"
      :type="errors.image ? 'is-danger' : ''"
      :message="errors.image[0]"
      ><drop-zone
        id="image"
        ref="dropzone"
        :class="[errors.image ? 'is-danger' : '']"
        :options="dropzoneOptions"
        :use-custom-slot="true"
        @vdropzone-max-files-exceeded="addLastOnly"
        @vdropzone-success="success"
        @vdropzone-removed-file="remove"
      >
        <p class="has-text-left">Select a category image to upload</p>
      </drop-zone></b-field
    >

    <b-field horizontal>
      <p class="control">
        <button class="button is-link is-outlined">
          {{ slug ? 'Save' : 'Add' }} Category
        </button>
      </p>
    </b-field>
  </form>
</template>

<script>
import api, { headers, http } from '../api'

export default {
  name: 'CategoryModify',
  props: { slug: { type: String, default: null } },
  data() {
    return {
      done: false,
      form: {
        name: '',
        description: '',
        image: '',
        display_order: '',
      },
      errors: {
        name: '',
        description: '',
        image: '',
        display_order: '',
      },
      dropzoneOptions: {
        url: '/api/images',
        thumbnailWidth: 200,
        thumbnailHeight: 120,
        thumbnailMethod: 'contain',
        addRemoveLinks: true,
        withCredentials: true,
        maxFiles: 1,
        headers,
      },
    }
  },
  mounted() {
    this.initDropZone()
  },
  methods: {
    initDropZone() {
      if (!this.slug) return

      const category = this.$store.getters.category(this.slug)

      if (category) {
        this.form = Object.assign({}, this.form, category)
        this.fetchThumbnail()
      } else {
        const unwatch = this.$store.watch(
          state => state.categories,
          () => {
            this.form = Object.assign(
              {},
              this.form,
              this.$store.getters.category(this.slug),
            )
            this.fetchThumbnail()
            unwatch()
          },
        )
      }
    },
    fetchThumbnail() {
      http
        .get(`/images/${this.form.image}`)
        .then(res => res.blob())
        .then(res => {
          const file = {
            name: this.form.image,
            size: res.size,
            type: res.type,
          }

          /**
           * FIXME: Doesn't support SVG
           * @see https://github.com/rowanwins/vue-dropzone/pull/434
           */
          this.$refs.dropzone.manuallyAddFile(file, `/images/${this.form.image}`)
        })
    },
    addLastOnly(file) {
      this.$refs.dropzone.removeAllFiles()
      this.$refs.dropzone.addFile(file)
    },
    async remove() {
      if (this.done || this.slug) return

      const res = await api.delete(`images/${this.form.image}`).text()
      console.log(res)

      this.$store.state.categories.forEach(c => {
        if (this.$slugify(c.name) === this.slug) {
          c.image = ''
        }
      })

      this.form.image = ''
    },
    success(file, response) {
      this.errors.image = ''
      this.form.image = response.message
    },
    async submit() {
      let res
      let message
      try {
        if (this.slug) {
          const { id } = this.$store.getters.category(this.slug)
          res = await api.put(`categories/${id}`, { json: this.form }).json()
          message = `${this.form.name} has been updated.`
        } else {
          res = await api.post('categories', { json: this.form }).json()
          message = `${this.form.name} has been added.`
        }
      } catch (e) {
        const res = await e.response.json()
        this.errors = Object.assign({}, this.errors, res.errors)
        this.$toast.open({
          message: res.message,
          type: 'is-danger',
          position: 'is-bottom',
        })
        return
      }

      this.done = true
      await this.$store.dispatch('fetchCategories')
      this.$router.push(`/categories/${this.$slugify(this.form.name)}`, () => {
        this.$toast.open({
          message,
          type: 'is-success',
          position: 'is-bottom',
        })
      })
    },
  },
}
</script>
