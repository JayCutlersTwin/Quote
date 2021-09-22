<template lang="html">
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
                <div>
                    <div class="w-full flex">
                        <div class="col-md-4 px-1" v-for="quote in quotes.quoteProduct">
                            <div class="border-2 rounded border-solid my-2 w-full">
                                <div class="w-full">
                                    <div class="px-3 pb-3">
                                        <h4 class="mb-2 text-xl text-center">{{ quote.productname }}</h4>
                                        <p class="mb-2 leading-4 text-center">{{ quote.description }}</p>
                                        <h6 class="mb-3 text-center">${{ quote.price }}</h6>
                                        <h6 class="mb-3 text-center">${{ quote.quantity }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="border-2 rounded border-solid w-full my-2">
                        <div class="container">
                            <div class="p-3">
                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">VAT(20%): </h6>
                                    <h6 class="my-2 block">${{ vat }}</h6>
                                </div>

                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">Subtotal: </h6>
                                    <h6 class="my-2 block">${{ subtotal }}</h6>
                                </div>
                                <hr>
                                <div class="flex flex-row justify-between">
                                    <h6 class="my-2 block">Total: </h6>
                                    <h6 class="my-2 block">${{ total }}</h6>
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
