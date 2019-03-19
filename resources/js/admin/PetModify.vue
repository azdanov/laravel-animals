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
        placeholder="Pet name"
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
        placeholder="Description for this pet"
        required
        expanded
        type="textarea"
        @blur="errors.description = ''"
      ></b-input>
    </b-field>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label for="price" class="label">
          Price
        </label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control is-expanded is-clearfix">
            <cleave
              id="price"
              v-model="form.price"
              name="price"
              placeholder="Pet price"
              :class="['input', errors.price ? 'is-danger' : '']"
              required="required"
              :options="cleaveOptions"
            ></cleave>
          </div>
          <p v-if="errors.price" class="help is-danger">{{ errors.price[0] }}</p>
        </div>
      </div>
    </div>

    <b-field
      horizontal
      label="Category"
      label-for="category_id"
      :type="errors.category_id ? 'is-danger' : ''"
      :message="errors.category_id[0]"
    >
      <b-select
        v-model="form.category_id"
        placeholder="Select a pet category"
        expanded
        required
      >
        <option v-for="c of categories" :key="c.id" :value="c.id">{{ c.name }}</option>
      </b-select>
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
        <p class="has-text-left">Select a pet image to upload</p>
      </drop-zone></b-field
    >

    <b-field horizontal>
      <p class="control">
        <button class="button is-link is-outlined">
          {{ slug ? 'Save' : 'Add' }} Pet
        </button>
      </p>
    </b-field>
  </form>
</template>

<script>
import { mapState } from 'vuex'
import api, { headers, http } from '../api'
import cleave from 'vue-cleave-component'

export default {
  name: 'PetModify',
  components: {
    cleave,
  },
  props: { slug: { type: String, default: null } },
  data() {
    return {
      done: false,
      form: {
        name: '',
        description: '',
        image: '',
        price: null,
        category_id: null,
      },
      errors: {
        name: '',
        description: '',
        image: '',
        price: '',
        category_id: '',
      },
      cleaveOptions: {
        prefix: '€ ',
        numeral: true,
        numeralPositiveOnly: true,
        noImmediatePrefix: true,
        rawValueTrimPrefix: true,
        numeralIntegerScale: 9,
        numeralDecimalScale: 2,
        delimiter: ' ',
        numeralDecimalMark: ',',
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
  computed: mapState(['categories']),
  mounted() {
    this.initDropzone()
  },
  methods: {
    initDropzone() {
      if (!this.slug) return

      const pet = this.$store.getters.pet(this.slug)

      if (pet) {
        this.form = Object.assign({}, this.form, pet)
        this.fetchThumbnail()
      } else {
        const unwatch = this.$store.watch(
          state => state.petGroups,
          () => {
            this.form = Object.assign({}, this.form, this.$store.getters.pet(this.slug))
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
          const { id } = this.$store.getters.pet(this.slug)
          res = await api.put(`pets/${id}`, { json: this.form }).json()
          message = `${this.form.name} has been updated.`
        } else {
          res = await api.post('pets', { json: this.form }).json()
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
      await this.$store.dispatch('fetchPetGroups')
      this.$router.push(`/pets/${this.$slugify(this.form.name)}`, () => {
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
