<template>
    <div>
        <h3 class="text-center mt-4">Add Quote</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <label for="quotename" class="mt-4">Quote Name</label>
                        <input type="text" name="quotename" id="quotename" class="form-control mt-2" v-model="formData.quotename">

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.quotename">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="customer" class="mt-4">Select a Customer</label>
                        <select class="form-control mt-2" name="customer" v-model="formData.customer_id">
                            <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                {{ customer.id }} {{ customer.firstname }} {{ customer.lastname }}
                            </option>
                        </select>

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.customer_id">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Add Quote</button>
                </form>
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
                formData: {
                    quotename: null,
                    customer_id: null,
                },
                errors: []
            }
        },
        mounted() {
            this.getCustomers();

        },
        methods: {
            getCustomers(){
                axios.get('/api/customers')
                .then((response) => {
                    this.customers = response.data;
                }).catch((error) => {
                        console.log(error);
                    });
            },
            create() {
                axios.post('/api/quotes/store', this.formData)
                .then((response) => {
                    console.log('Quote Created');
                    this.$router.push({
                        name: 'quotes'
                    });
                }).catch((error) => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        }
    }
</script>
