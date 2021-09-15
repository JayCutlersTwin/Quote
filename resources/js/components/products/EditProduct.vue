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

                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control" v-model="product.description">

                        <label for="price">Price</label>
                        <input type="text" id="price" class="form-control" v-model="product.price">

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
                product: {}
            }
        },
        methods: {
            update() {
                this.axios.post(`/api/products/update/${this.$route.params.id}`, this.product)
                    .then((response) => {
                        this.$router.push({
                            name: 'products'
                        });
                    });
            }
        }
    }
</script>
