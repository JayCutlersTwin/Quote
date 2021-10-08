<template lang="html">
    <div>
        <h3 class="text-center">Edit Customer</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="update">

                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" class="form-control" v-model="customer.firstname" required>

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.firstname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" class="form-control" v-model="customer.lastname" required>

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
                        <input id="streetname" type="text" class="form-control" v-model="customer.streetname" required>

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.streetname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="city">City</label>
                        <input id="city" type="text" class="form-control" v-model="customer.city" required>

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.city">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="postcode">Post Code</label>
                        <input id="postcode" type="text" class="form-control" v-model="customer.postcode" required>

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.postcode">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" v-model="customer.email" required>

                    <div v-if="this.errors !== 0">
                        <div v-for="error in this.errors.email">
                            <div class="alert alert-danger">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                    <label for="phone">Phone</label>
                    <input id="phone" type="text" class="form-control" v-model="customer.phone" required>

                    <div v-if="this.errors !== 0">
                        <div v-for="error in this.errors.phone">
                            <div class="alert alert-danger">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success  mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        created(){
            this.axios.get(`/api/customers/edit/${this.$route.params.id}`)
            .then((response) => {
                this.customer = response.data;
            }).catch((errors) => {
                console.log(errors)
            })
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                customer: {},
                errors: []
            }
        },
        methods: {
            update() {
                this.axios.post(`/api/customers/update/${this.$route.params.id}`, this.customer)
                    .then((response) => {
                        this.$router.push({name: 'customers'});
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    })
            }
        }
    }
</script>
