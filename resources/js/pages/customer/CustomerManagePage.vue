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
                    <div class="mt-8">
                        <label required for="address">Address</label>
                        <div class="mt-2">
                        <input-text v-model="item.address" id="address" name="address"/>
                        <span class="text-xs text-red">{{errors['address']}}</span>
                        </div>
                    </div>      
                    <div class="mt-8">
                        <div v-for="industry,index in industries" :key="index">
                          {{industry.name}}
                                  <input
                                    type="radio"
                                    id="industry_id"
                                    class="custom-control-input"
                                    v-model="item.industry_id"
                                    :value="industry.id"
                                  />
                        </div>
                        <span class="text-xs text-red">{{errors['industry_id']}}</span>
                    </div>                                  
                    <div class="mt-8">
                        <div v-for="city,index in cities" :key="index">
                          {{city.name}}
                                  <input
                                    type="radio"
                                    id="city"
                                    class="custom-control-input"
                                    v-model="item.city_id"
                                    :value="city.id"
                                  />
                        </div>
                        <span class="text-xs text-red">{{errors['city_id']}}</span>
                    </div>

                    <div class="mt-6">
                    <router-link :to="{ name: 'customers' }"
                            class="mt-6 mr-6 px-8 py-3 border border-solid border-black text-base font-medium rounded-xl text-black bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-n4">
                        Cancel
                    </router-link>
                    <button type="submit"
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
      title: 'Customer',
    }
  },
  components: {InputText},
  data() {
    return {
      item: {},
      cities: null,
      industries: null,
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
    this.getCities();
    this.getIndustries();
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

        if (!this.item.city_id) {
          label = "City required.";
          this.errors.push(label);
          this.errors["city_id"] = label;
        }

        if (!this.item.industry_id) {
          label = "Industry required.";
          this.errors.push(label);
          this.errors["industry_id"] = label;
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
    async getCities() {
      this.loading = true;
      let uri = '/api/cities/';
      this.$http.get(uri)
        .then((response) => {
            this.cities = response.data
        }).catch(error => {
            console.log('Error loading data: ' + error),
            this.errored = true,
            this.loading = false
        }).finally(() =>
            this.loading = false
        );

    },
    async getIndustries() {
      this.loading = true;
      let uri = '/api/industries/';
      this.$http.get(uri)
        .then((response) => {
            this.industries = response.data
        }).catch(error => {
            console.log('Error loading data: ' + error),
            this.errored = true,
            this.loading = false
        }).finally(() =>
            this.loading = false
        );

    },          
    async addItem() {

      if(!this.validateForm()){
        return;
      }
      if (!this.valid) return;
      this.loading = true;
      let uri = '/api/customers/';
      await this.$http.post(uri, this.item)
          .then((response) => {
            this.item = response.data,
            this.$router.push({name: 'customers'})
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
      let uri = '/api/customers/' + this.item.id;
      await this.$http.put(uri, this.item)
          .then(() => {
            this.$router.push({name: 'customers'})
          }).catch(error => {
            console.log('Error loading data: ' + error),
            this.errored = true,
            this.loading = false
        });
      this.loading = false;          
    },
    async getItem() {
      this.loading = true;
      let uri = '/api/customers/' + this.$route.params.id + '/edit';
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
