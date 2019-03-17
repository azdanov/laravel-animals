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
              Add Category
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
import slugify from '@sindresorhus/slugify'

export default {
  name: 'CategoryAdd',
  components: {
    'drop-zone': dropZone,
  },
  data() {
    return {
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
        url: '/api/image',
        thumbnailWidth: 200,
        addRemoveLinks: true,
        withCredentials: true,
        maxFiles: 1,
        headers,
      },
    }
  },
  methods: {
    addLastOnly(file) {
      this.$refs.dropzone.removeAllFiles()
      this.$refs.dropzone.addFile(file)
    },
    async remove() {
      const res = await api.delete(`image/${this.form.image}`).text()
      console.log(res)

      this.form.image = ''
    },
    success(file, response) {
      this.errors.image = ''
      this.form.image = response.message
    },
    async submit() {
      let res
      try {
        res = await api.post('categories', { json: this.form }).json()
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
