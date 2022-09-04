<template>
    <div class="max-w-9xl mx-auto sm:px-8 lg:px-16 w-full mb-7">
        <div class="mb-5 mt-5">
            <router-link
                class="bg-black text-white font-semibold leading-relaxed 
                px-8 py-3 rounded-xl mb-2"
                :to="{name: 'customers.create'}"
            >
            Create New Customer
            </router-link> 
        </div>
        <div class="mb-5 mt-5">
            <router-view></router-view>
        </div>
        <div>
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-emerald-600">ID</th>
                    <th class="px-4 py-2 text-emerald-600">Name</th>
                    <th class="px-4 py-2 text-emerald-600">Industry</th>
                    <th class="px-4 py-2 text-emerald-600">Contacts</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ customer.id }}</td>
                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ customer.name }}</td>
                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ customer.industry }}</td>
                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                        <router-link :to="{name: 'contacts.create', params: { customer_id: customer.id }}" class="btn btn-success mr-2 text-brown">
                                    <vue-feather  class="h-4 w-4 cursor-pointer mr-1" type="plus" ></vue-feather>New Contact
                        </router-link>
                        <div v-for="(contact,index) in customer.contacts" :key="index">
                            <li>
                                
                                <router-link :to="{name: 'contacts.edit', params: { id: contact.id }}" class="btn btn-success mr-2">
                                    <vue-feather  class="h-4 w-4 cursor-pointer text-orange-400" type="edit" ></vue-feather>
                                </router-link>
   
                                <span>{{contact.type.name}}: {{contact.value}}</span></li>
                        </div>
                    </td>

                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'customers.edit', params: { id: customer.id }}" class="btn btn-success mr-2">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
 

<script>
    export default {
        data() {
            return {
                customers: [],
            }
        },

        created() {
            console.log("URL",this.axios.defaults.baseURL);
            this.$http
                .get('api/customers/')
                .then(response => {
                    this.customers = response.data.data;
                });
        },
        methods: {
            deleteCustomer(id) { 
                this.$http
                    .delete(`/api/customers/${id}`)
                    .then(response => {
                        let i = this.customers.map(data => data.id).indexOf(id);
                        this.customers.splice(i, 1)
                    });
            }
        }
    }

    
</script>

