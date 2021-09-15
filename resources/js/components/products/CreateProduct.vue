<template>
    <div>
        <h3 class="text-center">Add a Product</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">
                        <!-- <label for="quote_id">Quote ID</label>
                        <select name="quote_id" id="quote_id" multiple required>
                            <option v-for="">
                            </option>
                        </select> -->

                        <label for="productname">Product</label>
                        <input type="text" id="productname" class="form-control mb-2" v-model="formData.productname">

                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control mb-2" v-model="formData.description">

                        <label for="price">Price</label>
                        <input type="text" id="price" class="form-control mb-2" v-model="formData.price">
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
                }
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
                    console.log(error)
                });
            }
        }
    }
</script>
