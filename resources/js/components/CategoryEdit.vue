<template>
  <form @submit.prevent="submit">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label for="name" class="label">Name</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control is-expanded">
            <input
              id="name"
              v-model="form.name"
              name="name"
              :class="['input', errors.name ? 'is-danger' : '']"
              type="text"
              required
              placeholder="Category name"
              @blur="errors.name = ''"
            />
          </div>
          <p v-if="errors.name" class="help is-danger">{{ errors.name[0] }}</p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label for="description" class="label">Description</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <textarea
              id="description"
              v-model="form.description"
              name="description"
              required
              :class="['textarea', errors.description ? 'is-danger' : '']"
              placeholder="Description for this category"
              @blur="errors.description = ''"
            ></textarea>
          </div>
          <p v-if="errors.description" class="help is-danger">
            {{ errors.description[0] }}
          </p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label for="order" class="label">Display Order</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              id="order"
              v-model="form.display_order"
              placeholder="Order of this category"
              :class="['input', errors.display_order ? 'is-danger' : '']"
              type="number"
              required
              min="1"
              name="order"
              @blur="errors.display_order = ''"
            />
          </div>
          <p v-if="errors.display_order" class="help is-danger">
            {{ errors.display_order[0] }}
          </p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label for="image" class="label">Image</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <drop-zone
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
            </drop-zone>
          </div>
          <p v-if="errors.image" class="help is-danger">{{ errors.image[0] }}</p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label">
        <!-- Left empty for spacing -->
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <button class="button is-link is-outlined">
              {{ slug ? 'Save' : 'Add' }} Category
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import api, { headers } from '../api'
import dropZone from 'vue2-dropzone'
import ky from 'ky'
import slugify from '@sindresorhus/slugify'

export default {
  name: 'CategoryEdit',
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
        display_order: null,
      },
      errors: {
        name: '',
        description: '',
        image: '',
        display_order: null,
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
      try {
        if (this.slug) {
          const { id } = this.$store.getters.category(this.slug)
          res = await api.put(`categories/${id}`, { json: this.form }).json()
        } else {
          res = await api.post('categories', { json: this.form }).json()
        }
      } catch (e) {
        const res = await e.response.json()
        this.errors = Object.assign({}, this.errors, res.errors)

        return
      }

      await this.$store.dispatch('fetchCategories')
      this.$router.push(`/categories/${slugify(this.form.name)}`)
    },
  },
}
</script>

<style lang="scss">
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
}
</style>
