<template lang="html">
    <div>
        <h3 class="text-center">Edit Customer</h3>
        <div class="row justify-center">
            <div class="col-md-6">
                <form method="post" @submit.prevent="update">

                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">
                        <label for="quotename">Quote Name </label>
                        <input type="text" id="quotename" class="form-control" v-model="quote.quotename">

                        <label for="customer">Customer</label>
                        <input type="text" id="customer" class="form-control" v-model="quote.customer_id">

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
            this.axios.get(`/api/quotes/edit/${this.$route.params.id}`)
            .then((response) => {
                this.quote = response.data;
            }).catch((errors) => {
                console.log(errors)
            })
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                quote: {}
            }
        },
        methods: {
            update() {
                this.axios.post(`/api/quotes/updateEdit/${this.$route.params.id}`, this.quote)
                    .then((response) => {
                        this.$router.push({
                            name: 'quotes'
                        });
                    });
            }
        }
    }
</script>
