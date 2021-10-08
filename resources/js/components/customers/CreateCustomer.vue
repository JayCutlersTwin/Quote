<template>
    <div>
        <h3 class="text-center">Add Customer</h3>
        <div class="row justify-center">
            <div class="col-md-6">

                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" class="form-control" v-model="formData.firstname">

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.firstname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" class="form-control" v-model="formData.lastname" >

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.lastname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="streetname">Street Name</label>
                        <input id="streetname" type="text" class="form-control" v-model="formData.streetname" >

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.streetname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="city">City</label>
                        <input id="city" type="text" class="form-control" v-model="formData.city" >

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.city">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="postcode">Post Code</label>
                        <input id="postcode" type="text" class="form-control" v-model="formData.postcode" >

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.postcode">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" v-model="formData.email" >

                    <div v-if="this.errors !== 0">
                        <div v-for="error in this.errors.email">
                            <div class="alert alert-danger">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                    <label for="phone">Phone</label>
                    <input id="phone" type="text" class="form-control" v-model="formData.phone" >

                    <div v-if="this.errors.phone !== 0">
                        <div v-for="error in this.errors.phone">
                            <div class="alert alert-danger">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary  mt-4">Add Customer</button>
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
                formData: {
                    firstname: "",
                    lastname: "",
                    streetname: "",
                    city: "",
                    postcode: "",
                    email: "",
                    phone: "",
                },
                success: false,
                errors: []
            }
        },
        mounted() {
            axios.get('/api/customers').then(response => {
                this.customers = response.data;
                this.success = true
            }).catch((error) => {
                console.log(error);
                this.success = false;
            });
        },
        methods: {
            create() {
                axios.post('/api/customers/store', this.formData)
                .then((response) => {
                    console.log('Customer Created');
                    this.$router.push({name: 'customers'});
                })
                .catch((error) => {
                    this.errors =  error.response.data.errors;
                });
            }
        }
    }
</script>
