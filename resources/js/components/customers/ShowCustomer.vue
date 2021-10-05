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

            <table class="table-fixed border-2 rounded border-solid my-2">
                <thead>
                    <th class="w-1/3 text-left p-4">Quote Name</th>
                    <th class="w-1/3 text-center p-4">Complete</th>
                    <th class="w-1/3 p-4"></th>
                </thead>
                <tbody>
                    <tr v-for="q in quote" :key="quote.id">
                        <td class="text-left p-4">{{ q.quotename }}</td>

                        <td class="text-center p-4">
                            <div v-if="q.order_complete === 0">
                                Order Incomplete
                            </div>
                            <div v-if="q.order_complete === 1">
                                Order Complete
                            </div>
                        </td>

                        <td class="text-right p-4">
                            <div class="inline-block">
                                <router-link class="btn btn-primary" :to="{ name: 'quotesShow', params: { id: q.id }}">View</router-link>
                            </div>
                            <div class="inline-block" v-if="q.order_complete === 0">
                                <router-link class="btn btn-primary" :to="{ name: 'quotesEdit', params: { id: q.id }}">Edit</router-link>
                                <button class="btn btn-danger" @click="destroyQuote(q.id)">Delete</button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>

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
