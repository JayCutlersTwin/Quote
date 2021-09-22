<template lang="html">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="mt-5"> Products</h3>
                    <router-link :to="{ name: 'productsCreate'}" class="float-right inline-block btn-sm btn-success">Add</router-link>

                    <div class="w-full flex flex-wrap">
                        <div class="col-md-4 px-1 min-h-312" v-for="product in products" :key="product.id">
                            <div class="border-2 rounded border-solid w-full m-1">
                                <div>
                                    <div class="p-5">
                                        <h4 class="mb-2 text-xl">{{ product.productname }}</h4>
                                        <p class="mb-2 leading-4 min-h-48">{{ product.description }}</p>
                                        <h6 class="mb-5 font-bold">${{ product.price }}</h6>

                                        <input type="hidden" name="_token" :value="csrf">
                                        <router-link class="btn-sm btn-primary" :to="{ name: 'productsEdit', params: { id: product.id } }">Edit</router-link>
                                        <button class="btn-sm btn-danger" @click="destroyProduct(product.id)">Delete</button>
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
            products: []
        }
    },

    methods: {
        getProducts(){
            axios.get('/api/products').then(response => {
                this.products = response.data
            });
        },

        destroyProduct(id) {
            this.axios.delete(`/api/products/delete/${id}`)
            .then(response => {
                let i = this.products.map(item => item.id).indexOf(id);
                this.products.splice(i, 1);
                console.log('Product deleted', `${id}`);
            })
            .catch((errors) => {
                console.log(errors)
            })
        }
    },
    mounted() {
        this.getProducts()
    },
}
</script>
