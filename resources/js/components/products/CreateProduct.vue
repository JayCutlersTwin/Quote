<template>
    <div>
        <h3 class="text-center">Add a Product</h3>
        <div class="row justify-center">
            <div class="col-md-6">

                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">

                        <label for="productname">Product</label>
                        <input type="text" id="productname" class="form-control mb-2" v-model="formData.productname">

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.productname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control mb-2" v-model="formData.description">

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.description">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="price">Price</label>
                        <input type="number" id="price" class="form-control mb-2" v-model="formData.price">

                        <div v-if="this.errors !== 0">
                            <div v-for="error in this.errors.price">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary  mt-4">Add Product</button>
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
                    productname: "",
                    description: "",
                    price: "",
                },
                errors: []
            }
        },
        mounted() {
            axios.get('/api/products').then(response => {
                this.products = response.data;
            })
        },
        methods: {
            create() {
                axios.post('/api/products/store', this.formData)
                .then((response) => {
                    console.log('Product Created');
                    this.$router.push({
                        name: 'products'
                    });
                }).catch((error) => {
                    this.errors =  error.response.data.errors;
                });
            }
        }
    }
</script>
