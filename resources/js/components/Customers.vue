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

                                    <div class="alert alert-success" v-show="success">Customer created successfully.</div>

                                    <table class="table-auto w-full text-center">
                                        <thead>
                                            <tr>
                                                <th class="p-2">Name</th>
                                                <th class="p-2">Address</th>
                                                <th class="p-2">Email</th>
                                                <th class="p-2">Phone</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="customer in customers" :key="customer.id">
                                                <td class="p-2">{{ customer.firstname }} {{ customer.lastname }}</td>
                                                <td class="p-2">
                                                    {{ customer.streetname }},<br>
                                                    {{ customer.city }},<br>
                                                    {{ customer.postcode }}
                                                </td>
                                                <td class="p-2">{{ customer.email }}</td>
                                                <td class="p-2">{{ customer.phone }}</td>
                                                <td class="p-2">
                                                    <div>
                                                        <router-link class="btn btn-primary inline-block" :to="{ name: 'customersShow', params: { id: customer.id }}">View</router-link>
                                                        <router-link class="btn btn-primary inline-block" :to="{ name: 'customersEdit', params: { id: customer.id }}">Edit</router-link>
                                                        <input type="hidden" name="_token" :value="csrf">
                                                        <button class="btn btn-danger inline-block" @click="destroyCustomer(customer.id)">Delete</button>
                                                    </div>
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
