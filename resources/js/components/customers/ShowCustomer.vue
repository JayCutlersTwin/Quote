<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <h2 class="text-center text-2xl font-bold">{{ customer.firstname }} {{ customer.lastname }}</h2>
            </div>

            <div class="flex p-0">
                <div class="border-2 rounded border-solid w-1/2 my-2 mr-2">
                    <div class="container p-4">
                        <h2 class="font-bold text-lg text-center">Address</h2>
                        <h6>
                            {{ customer.streetname }}, <br>
                            {{ customer.city }}, <br>
                            {{ customer.postcode }}
                        </h6>

                    </div>
                </div>
                <div class="border-2 rounded border-solid w-1/2 my-2 ml-2">
                    <div class="container p-4">
                        <h2 class="font-bold text-lg text-center">Contact</h2>
                        <h6>
                            Email: {{ customer.email }}<br>
                            Phone Number: {{ customer.phone }}
                        </h6>

                    </div>
                </div>
            </div>

            <div class="border-2 rounded border-solid w-full m-2 inline-flex">
                <div class="container p-4">
                    <h2 class="font-bold text-lg text-center">Quotes</h2>
                    <div class="p-2 flex justify-between" v-for="q in quote" :key="quote.id">

                        <h6 class="self-center">
                            {{ q.quotename }}
                        </h6>
                        <div>
                            <router-link class="btn-sm btn-primary" :to="{ name: 'quotesShow', params: { id: q.id }}">View</router-link>
                            <router-link class="btn-sm btn-primary" :to="{ name: 'quotesEdit', params: { id: q.id }}">Edit</router-link>
                            <button class="btn-sm btn-danger" @click="destroyQuote(q.id)">Delete</button>
                        </div>
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
                customer: [],
                quote: []
            }
        },
        mounted() {
            this.showCustomer()
        },
        methods: {
            showCustomer(id) {
                axios.get(`/api/customers/${this.$route.params.id}`)
                .then(response => {
                    this.customer = response.data.customer;
                    this.quote = response.data.quotes;
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
