<template>
    <div>
        <h3 class="text-center">Add Customer</h3>
        <div class="row justify-center">
            <div class="col-md-6">

                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" class="form-control" v-model="formData.firstname" required>

                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" class="form-control" v-model="formData.lastname" required>

                    </div>
                    <div class="form-group">
                        <label for="streetname">Street Name</label>
                        <input id="streetname" type="text" class="form-control" v-model="formData.streetname" required>

                        <label for="city">City</label>
                        <input id="city" type="text" class="form-control" v-model="formData.city" required>

                        <label for="postcode">Post Code</label>
                        <input id="postcode" type="text" class="form-control" v-model="formData.postcode" required>
                    </div>

                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" v-model="formData.email" required>

                    <label for="phone">Phone</label>
                    <input id="phone" type="text" class="form-control" v-model="formData.phone" required>

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
                allerrors: [],
                success: false,
            }
        },
        mounted() {
            axios.get('/api/customers').then(response => {
                this.customers = response.data;
                this.success = true
            }).catch((error) => {
                this.allerrors = error.response.data.errors;
                this.success = false;
            });
        },
        methods: {
            create() {
                axios.post('/api/customers/store', this.formData).then((response) => {
                    console.log('Customer Created');
                    this.$router.push({name: 'customers'});
                }).catch((error) => {
                    console.log(error)
                });
            }
        }
    }
</script>
