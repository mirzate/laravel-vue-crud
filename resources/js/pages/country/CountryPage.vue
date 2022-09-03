<template>
    <div>

        <div class="justify-center flex  items-center h-screen">

 
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
                        <router-link :to="{name: 'countries.edit', params: { id: country.id }}" class="btn btn-success">Edit</router-link>
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
                countries: []
            }
        },
        created() {
            this.$http
                .get('http://localhost:8081/api/countries/')
                .then(response => {
                    this.countries = response.data;
                });
        },
        methods: {
            deletecountry(id) { 
                this.$http
                    .delete(`http://localhost:8081/api/countries/${id}`)
                    .then(response => {
                        let i = this.countries.map(data => data.id).indexOf(id);
                        this.countries.splice(i, 1)
                    });
            }
        }
    }
</script>