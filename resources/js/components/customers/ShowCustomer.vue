<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <h2>{{ customer.firstname }} {{ customer.lastname }}</h2>
            </div>

            <div class="flex p-0">
                <div class="border-2 rounded border-solid w-1/2 my-2 mr-2">
                    <div class="container p-4">
                        <h2 class="font-bold text-lg text-center">Address</h2>
                        <h6>
                            {{ customer.customer.streetname }}, <br>
                            {{ customer.customer.city }}, <br>
                            {{ customer.customer.postcode }}
                        </h6>

                    </div>
                </div>
                <div class="border-2 rounded border-solid w-1/2 my-2 ml-2">
                    <div class="container p-4">
                        <h2 class="font-bold text-lg text-center">Contact</h2>
                        <h6>
                            Email: {{ customer.customer.email }}<br>
                            Phone Number: {{ customer.customer.phone }}
                        </h6>

                    </div>
                </div>
            </div>

            <div class="border-2 rounded border-solid w-full m-2 inline-flex">
                <div class="container p-4">
                    <h2 class="font-bold text-lg text-center">Quotes</h2>
                    <div class="p-2" v-for="quote in customer.quotes" :key="quote.id">
                        <h6>
                            {{ quote.quotename }}
                        </h6>
                        <router-link class="btn-sm btn-primary" :to="{ name: 'quotesShow', params: { id: quote.id }}">View</router-link>
                        <router-link class="btn-sm btn-primary" :to="{ name: 'quotesEdit', params: { id: quote.id }}">Edit</router-link>
                        <button class="btn-sm btn-danger" @click="destroyQuote(customer.quotes.id)">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                customer: []
            }
        },
        mounted() {
            this.showCustomer()
        },
        methods: {
            showCustomer(id) {
                axios.get(`/api/customers/${this.$route.params.id}`)
                .then(response => {
                    this.customer = response.data;
                })
                .catch(function () {
                    alert('cannot load customer Information')
                });
            },
            destroyQuote(id) {
                this.axios.delete(`/api/quotes/delete/${id}`)
                .then(response => {
                    let i = this.quotes.map(item => item.id).indexOf(id);
                    this.quotes.splice(i, 1);
                    console.log('Quote deleted', `${id}`);
                })
                .catch((errors) => {
                    console.log(errors)
                })
            }
        }
    }
</script>
