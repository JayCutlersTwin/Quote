<template>
    <div>
        <h3 class="text-center">Add a Product to a quote</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="create">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">

                        <label>Select a Quote</label>
                        <select class="form-control mt-2" name="quote_id" id="quote_id" v-model="formData.quote_id">
                            <option v-for="quote in quotes" :key="quote.id" :value="quote.id">
                                {{ quote.id }} {{ quote.quotename }}
                            </option>
                        </select>

                        <label>Select a Product</label>
                        <select class="form-control mt-2" name="product_id" id="product_id" v-model="formData.product_id">
                            <option v-for="product in products" :key="product.id" :value="product.id">
                                {{ product.id }} {{ product.productname }}
                            </option>
                        </select>

                        <label for="quantity">Product Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control mb-2" v-model="formData.quantity">
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
                quotes: [],
                products: [],
                formData: {
                    quote_id: null,
                    product_id: null,
                    quantity: ""
                }
            }
        },
        mounted() {
            this.getQuote();
            this.getProduct();
        },
        methods: {
            create() {
                axios.post('/api/quoteproduct/store', this.formData)
                .then((response) => {
                    console.log('Quote Product Created');
                    this.$router.push({
                        name: 'quote_products'
                    });
                }).catch((error) => {
                    console.log(error)
                });
            },
            getQuote(){
                axios.get('/api/quotes').then(response => {
                    this.quotes = response.data;
                })
            },
            getProduct(){
                axios.get('/api/products').then(response => {
                    this.products = response.data;
                })
            }
        }
    }
</script>
