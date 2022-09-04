<template>
    <div class="max-w-9xl mx-auto sm:px-8 lg:px-16 w-full mb-7">
        <div class="mb-5 mt-5">
            <router-link
                class="bg-black text-white font-semibold leading-relaxed 
                px-8 py-3 rounded-xl mb-2"
                :to="{name: 'customers.create'}"
            >
            Create New
            </router-link> 
        </div>
        <div class="mb-5 mt-5">
            <router-view></router-view>
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Industry</th>
                    <th>Contacts</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.industry }}</td>
                    <td>
                        <div v-for="(contact,index) in customer.contacts" :key="index">
                            <li>
                                <router-link :to="{name: 'contacts.edit', params: { id: contact.id }}" class="btn btn-success mr-2">Edit</router-link>
                                <span>{{contact.type.name}}: {{contact.value}}</span></li>
                        </div>
                    </td>

                    <td>
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
            this.$http
                .get('http://localhost:8081/api/customers/')
                .then(response => {
                    this.customers = response.data.data;
                });
        },
        methods: {
            deleteCustomer(id) { 
                this.$http
                    .delete(`http://localhost:8081/api/customers/${id}`)
                    .then(response => {
                        let i = this.customers.map(data => data.id).indexOf(id);
                        this.customers.splice(i, 1)
                    });
            }
        }
    }

    
</script>

