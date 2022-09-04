<template>
    <div class="max-w-9xl mx-auto sm:px-8 lg:px-16 w-full mb-7">
        <div class="md:grid md:grid-cols-8 md:gap-x-8">
            <div class="col-span-5">
                <div>
                <form ref="form" novalidate="false" @submit.prevent="onSubmit" @change="validateForm()" method="POST">


                    <div class="mt-8">
                        <label required for="name">Name</label>
                        <div class="mt-2">
                        <input-text v-model="item.name" id="name" name="name" required/>
                        <span class="text-xs text-red">{{errors['name']}}</span>
                        </div>
                    </div>


                    <div class="mt-6">
                    <router-link :to="{ name: 'countries' }"
                            class="mt-6 mr-6 px-8 py-3 border border-solid border-black text-base font-medium rounded-xl text-black bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-n4">
                        Cancel
                    </router-link>
                    <button type="submit"
                            :disabled="loading"
                            class="mt-6 px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        {{ buttonText }}
                    </button>

                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import InputText from "../../components/InputText.vue";
//import ErrorMsg from "@/components/layout/form/MlErrorMsg";

export default {
  metaInfo() {
    return {
      title: 'Countries',
    }
  },
  components: {InputText},
  data() {
    return {
      taxes: [],
      taxTypes: [],
      categories: [],
      cat: [],
      addons: [],
      fees: [],
      quote: null,
      item: {
        name: null,
        is_published: false,
        quote: null,
        package_discount: 0,
        tax_inclusive: false,
        addons: [],
        fees: [],
        products: [],
      },
      selectedFile: null,
      imageUploadError: null,
      imageUpload:false,      
      loading: false,
      file: null,
      rules: {
        required: value => !!value || 'Required.'
      },
      valid: true,
      lazy: true,
      errored: false,
      errors: []

    }
  },
  mounted: function () {

    if (this.$route.params.id) {
     this.getItem();
    }

  },
  computed: {
    buttonText() {
      return this.item.id ? 'Save' : 'Create'
    },
  },
  methods: {
    validateForm() {

      this.errors = [];
      let label = '';

        if (!this.item.name) {
          label = "Name required.";
          this.errors.push(label);
          this.errors["name"] = label;
        }

      if (!this.errors.length) {
        this.valid = true;
        return true;
      }

      this.valid = false;
      return false;

    },
    onSubmit(){
      if(this.validateForm()) this.dataEdit();
    },    
    async dataEdit() {

      if (this.item.id) {
        this.updateItem();
      } else {
        this.addItem();
      }
    },
    async addItem() {

      if(!this.validateForm()){
        return;
      }
      if (!this.valid) return;
      this.loading = true;
      let uri = '/api/countries/';
      await this.$http.post(uri, this.item)
          .then((response) => {
            this.item = response.data,
            this.$router.push({name: 'countries'})
          });
      this.loading = false;
    },
    async updateItem() {

      //await this.$refs.form.validate();
      if(!this.validateForm()){
        return;
      }
      this.loading = true;
      if (!this.valid) return;
      let uri = 'http://localhost:8081/api/countries/' + this.item.id;
      await this.$http.put(uri, this.item)
          .then(() => {
            this.$router.push({name: 'countries'})
          }).catch(error => {
            console.log('Error loading data: ' + error),
            this.errored = true,
            this.loading = false
        });
      this.loading = false;          
    },
    async getItem() {
      this.loading = true;
      let uri = 'http://localhost:8081/api/countries/' + this.$route.params.id + '/edit';
      this.$http.get(uri)
        .then((response) => {
            this.item = response.data
        }).catch(error => {
            console.log('Error loading data: ' + error),
            this.errored = true,
            this.loading = false
        }).finally(() =>
            this.loading = false
        );

    },
  }
}
</script>
