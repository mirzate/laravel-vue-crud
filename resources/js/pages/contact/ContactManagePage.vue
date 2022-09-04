<template>
    <div class="max-w-9xl mx-auto sm:px-8 lg:px-16 w-full mb-7">
        <div class="md:grid md:grid-cols-8 md:gap-x-8">
            <div class="col-span-5">
                <div>
                <form ref="form" novalidate="false" @submit.prevent="onSubmit" @change="validateForm()" method="POST">
                  <span class="text-xs text-red">{{errors['customer_id']}}</span>
                    <div class="mt-8">
                        <label required for="value">Value</label>
                        <div class="mt-2">
                        <input-text v-model="item.value" id="value" name="value" required/>
                        <span class="text-xs text-red">{{errors['value']}}</span>
                        </div>
                    </div>
                  
                    <div class="mt-8">
                        <div v-for="type,index in types" :key="index">
                          {{type.name}}
                                  <input
                                    type="radio"
                                    id="type"
                                    class="custom-control-input"
                                    v-model="item.contact_type_id"
                                    :value="type.id"
                                  />
                        </div>
                        <span class="text-xs text-red">{{errors['contact_type_id']}}</span>
                    </div>
                    <div class="mt-6">
                    <router-link :to="{ name: 'customers' }"
                            class="mt-6 mr-6 px-8 py-3 border border-solid border-black text-base font-medium rounded-xl text-black bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-n4">
                        Cancel
                    </router-link>
                    <button type="submit"
                            :disabled="loading"
                            class="mt-6 px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        {{ buttonText }}
                    </button>
                    <button @click="deleteContact(this.item.id)" :disabled="!this.item.id"
                        class="mt-6 ml-3 px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-red focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                      Delete
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

export default {
  metaInfo() {
    return {
      title: 'Contacts',
    }
  },
  components: {InputText},
  data() {
    return {
      item: {
        customer_id: null,
        contact_type_id: null
      },
      selectedFile: null,
      loading: false,
      rules: {
        required: value => !!value || 'Required.'
      },
      valid: true,
      lazy: true,
      errored: false,
      errors: [],
      types: null
    }
  },
  mounted: function () {

    this.getTypes();
    if (this.$route.params.id) {
     this.getItem();
    }
    if(this.$route.params.customer_id){
      this.item.customer_id = this.$route.params.customer_id;
    }
  },
  computed: {
    buttonText() {
      return this.item.id ? 'Save Contact' : 'Create Contact'
    },
  },
  methods: {
    validateForm() {

      this.errors = [];
      let label = '';

        if (!this.item.value) {
          label = "Value required.";
          this.errors.push(label);
          this.errors["value"] = label;
        }
        if (!this.item.contact_type_id) {
          label = "Type required.";
          this.errors.push(label);
          this.errors["contact_type_id"] = label;
        }        
        if (!this.item.customer_id) {
          label = "Customer required.";
          this.errors.push(label);
          this.errors["customer_id"] = label;
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
    deleteContact(id) { 
        this.$http
            .delete(`/api/contacts/${id}`)
            .then(response => {
                this.$router.push({name: 'customers'})
        });
    },    
    async addItem() {

      if(!this.validateForm()){
        return;
      }
      if (!this.valid) return;
      this.loading = true;
      let uri = '/api/contacts/';
      await this.$http.post(uri, this.item)
          .then((response) => {
            this.item = response.data
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
      let uri = '/api/contacts/' + this.item.id;
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
      let uri = '/api/contacts/' + this.$route.params.id + '/edit';
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
    async getTypes() {
      this.loading = true;
      let uri = '/api/contact-types/';
      this.$http.get(uri)
        .then((response) => {
            this.types = response.data
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
