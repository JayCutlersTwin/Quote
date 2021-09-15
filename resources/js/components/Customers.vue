<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-lg text-center inline-block">Customer List</h3>
                        <router-link :to="{ name: 'customersCreate'}" class="float-right inline-block btn-sm btn-success">Add</router-link>
                    </div>

                    <div class="card-body">
                        <div class="container mx-auto">
                            <div class="border-2 rounded border-solid">
                                <div class="container mx-auto">

                                    <div class="alert alert-success" v-show="success">Customer created successfully.</div>

                                    <table class="table-auto w-full text-center">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="customer in customers" :key="customer.id">
                                                <td>{{ customer.firstname }} {{ customer.lastname }}</td>
                                                <td>
                                                    {{ customer.streetname }},<br>
                                                    {{ customer.city }},<br>
                                                    {{ customer.postcode }}
                                                </td>
                                                <td>{{ customer.email }}</td>
                                                <td>{{ customer.phone }}</td>
                                                <td><router-link :to="{ name: 'customersShow', params: { id: customer.id }}">View</router-link></td>
                                                <td><router-link :to="{ name: 'customersEdit', params: { id: customer.id }}">Edit</router-link></td>
                                                <td>
                                                        <input type="hidden" name="_token" :value="csrf">
                                                        <button class="btn btn-danger" @click="destroyCustomer(customer.id)">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {

        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                customers: [],
                success: false
            };
        },

        methods: {
            getCustomers(){
                axios.get('/api/customers').then(response => {
                    this.customers = response.data
                });
            },

            destroyCustomer(id) {
                this.axios.delete(`/api/customers/delete/${id}`)
                .then(response => {
                    let i = this.customers.map(item => item.id).indexOf(id);
                    this.customers.splice(i, 1);
                    console.log('Customer deleted', `${id}`);
                })
                .catch((errors) => {
                    console.log(errors)
                })
            }
        },
        mounted() {
            this.getCustomers()
        },
    }
</script>
