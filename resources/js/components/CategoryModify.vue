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
        :destroy-dropzone="false"
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
import api, { headers } from '../api'
import dropZone from 'vue2-dropzone'
import ky from 'ky'
import slugify from '@sindresorhus/slugify'

export default {
  name: 'CategoryModify',
  components: {
    'drop-zone': dropZone,
  },
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
    if (!this.slug) return

    const category = this.$store.getters.category(this.slug)

    if (category) {
      this.form = Object.assign({}, this.form, category)
      this.fetchThumbnail()
    } else {
      const unwatch = this.$store.watch(
        state => state.categories,
        categories => {
          this.form = Object.assign(
            {},
            this.form,
            categories.filter(c => slugify(c.name) === this.slug).pop(),
          )
          this.fetchThumbnail()
          unwatch()
        },
      )
    }
  },
  methods: {
    fetchThumbnail() {
      ky.get(`/images/${this.form.image}`)
        .then(res => res.blob())
        .then(res => {
          const file = {
            name: this.form.image,
            size: res.size,
            type: res.type,
          }
          console.log(res, file)

          /**
           * FIXME: Doesn't support SVG
           * @see https://github.com/rowanwins/vue-dropzone/blob/25ce7942ecdafbd91c5e60bc6d3567403bf57b95/src/components/vue-dropzone.vue#L264
           */
          this.$refs.dropzone.manuallyAddFile(file, `/images/${this.form.image}`)
        })
    },
    addLastOnly(file) {
      this.$refs.dropzone.removeAllFiles()
      this.$refs.dropzone.addFile(file)
    },
    async remove() {
      if (this.done) return

      const res = await api.delete(`images/${this.form.image}`).text()
      console.log(res)

      this.$store.state.categories.forEach(c => {
        if (slugify(c.name) === this.slug) {
          c.image = ''
        }
      })

      this.form.image = ''
    },
    success(file, response) {
      this.done = true
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

        return
      }

      await this.$store.dispatch('fetchCategories')
      this.$router.push(`/categories/${slugify(this.form.name)}`, () => {
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

<style lang="scss">
@import '~vue2-dropzone/dist/vue2Dropzone.min.css';

.dropzone {
  border-radius: 4px;
  background-color: hsl(0, 0%, 100%);
  border: 1px solid hsl(0, 0%, 86%);
  color: hsl(0, 0%, 76%);
  box-shadow: inset 0 1px 2px rgba(10, 10, 10, 0.1);
  max-width: 100%;
  width: 100%;
  padding: 0.625em;
  min-height: 100px;

  &:hover {
    cursor: pointer;
    border-color: hsl(0, 0%, 71%);
  }

  &.is-danger {
    border-color: hsl(348, 100%, 61%);
  }

  .dz-message {
    margin: 0;
  }

  .dz-preview {
    margin: 0;
    .dz-image {
      border-radius: 4px;
    }
  }
}

.vue-dropzone {
  transition: none;

  &:hover {
    background-color: hsl(0, 0%, 100%);
  }

  & > .dz-preview .dz-details {
    background-color: hsl(263, 64%, 70%);
  }
}
</style>
