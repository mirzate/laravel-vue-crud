<template>
    <div class="max-w-9xl mx-auto sm:px-8 lg:px-16 w-full mb-7">

        <div class="mb-5 mt-5">
            <router-link
                class="bg-black text-white font-semibold leading-relaxed 
                px-8 py-3 rounded-xl mb-2"
                :to="{name: 'countries.create'}"
            >
            Create New
            </router-link> 
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="country in countries" :key="country.id">
                    <td>{{ country.id }}</td>
                    <td>{{ country.name }}</td>
                    <td>{{ country.detail }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'countries.edit', params: { id: country.id }}" class="btn btn-success mr-2">Edit</router-link>
                            <button class="btn btn-danger" @click="deletecountry(country.id)">Delete</button>
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
                countries: [],

            }
        },
      
        created() {
            this.$http
                .get('/api/countries/')
                .then(response => {
                    this.countries = response.data;
                });
        },
        methods: {
            deletecountry(id) { 
                this.$http
                    .delete(`/api/countries/${id}`)
                    .then(response => {
                        let i = this.countries.map(data => data.id).indexOf(id);
                        this.countries.splice(i, 1)
                    });
            }
        }
    }

    
</script>

