<template>
    <div>
        <h3 class="text-center">Add Customer</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="update">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">
                        <label for="productname">Product</label>
                        <input type="text" id="productname" class="form-control" v-model="product.productname">

                        <div v-if="this.errors.productname !== 0">
                            <div v-for="error in this.errors.productname">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control" v-model="product.description">

                        <div v-if="this.errors.description !== 0">
                            <div v-for="error in this.errors.description">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <label for="price">Price</label>
                        <input type="text" id="price" class="form-control" v-model="product.price">

                        <div v-if="this.errors.price !== 0">
                            <div v-for="error in this.errors.price">
                                <div class="alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary  mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created(){
            this.axios.get(`/api/products/edit/${this.$route.params.id}`)
            .then((response) => {
                this.product = response.data;
            }).catch((errors) => {
                console.log(errors)
            })
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                product: {},
                errors: []
            }
        },
        methods: {
            update() {
                this.axios.post(`/api/products/update/${this.$route.params.id}`, this.product)
                    .then((response) => {
                        this.$router.push({
                            name: 'products'
                        });
                    })
                    .catch((error) => {
                        this.errors =  error.response.data.errors;
                    });
            }
        }
    }
</script>
