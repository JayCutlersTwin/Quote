<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">

                <div class="border-2 rounded border-solid w-full my-2">
                    <div class="container">
                        <div class="p-3">
                            <div class="p-2" v-for="c in quotes.customer">
                                <h2 class="font-bold text-lg text-center">{{ c.quotename }}</h2>
                                <h6 class="mb-2 font-bold">Customer Info:</h6>
                                <h6 class="mb-2">Customer Number: {{ c.customer_id }}</h6>
                                <h6 class="mb-2">Customer Name: {{ c.firstname }} {{ c.lastname }}</h6>
                                <h6 class="mb-2">Customer Email: {{ c.email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div >
                    <div class="border-2 rounded border-solid w-1/3 my-2 inline-flex even:mx-1" v-for="quote in quotes.products">
                        <div class="container">
                            <div class="p-3">
                                <h4 class="mb-2 text-xl text-center">{{ quote.productnames }}</h4>
                                <p class="mb-2 leading-4 text-center">{{ quote.description }}</p>
                                <h6 class="mb-3 text-center">${{ quote.price }}</h6>
                                <div>
                                    <quantityCounter v-bind:quantity="item.quantity" v-on:input="item.quantity=$event" v-on:increment-quantity='item.quantity++' v-on:decrement-quantity="item.quantity--"></quantityCounter>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 rounded border-solid w-full my-2">
                        <div class="container">
                            <div class="p-3">
                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">VAT(20%): </h6>
                                    <h6 class="my-2 block" v-for="quote in quotes.products">${{ ((quote.price) * 0.20) * (item.quantity) }}</h6>
                                </div>

                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">Subtotal: </h6>
                                    <h6 class="my-2 block" v-for="quote in quotes.products">${{ ((quote.price) * (item.quantity)) - ((quote.price) * 0.20) * (item.quantity) }}</h6>
                                </div>
                                <hr>
                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">Total: </h6>
                                    <h6 class="my-2 block" v-for="quote in quotes.products">${{ (quote.price) * (item.quantity) }}</h6>
                                </div>
                                <div class="flex justify-center my-2">
                                    <button class="btn-lg btn-success" type="button" name="button">Complete</button>
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
    export default {
        data() {
            return {
                quotes: [],
                item: {
                    quantity: 0
                }
            }
        },
        mounted(id) {
            axios.get(`/api/quotes/${this.$route.params.id}`).then(response => {
                this.quotes = response.data;
            })
            .catch(function() {
                alert('cannot load quote Information')
            });
        },
    }
</script>
