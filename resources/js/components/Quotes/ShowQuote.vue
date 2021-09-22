<template>
    <div class="">
        <div v-show="isModalVisible">
            <div class="w-full h-full opacity-65 m-confirmModalMargins bg-white bg-opacity-75 fixed" >
                <div class="bg-white">
                    <div class="border-2 rounded border-solid my-2 top-calcModalConfirmTop left-calcModalConfirmLeft fixed bg-white bg-opacity-100">
                        <div class="p-10">
                            <div>
                                <p class="mb-2">are you sure you want to confirm this?</p>
                                <div class="flex justify-center">
                                    <button type="button" name="button" class="btn btn-danger mr-1" @click="closeModal">No</button>
                                    <button type="button" name="button" class="btn btn-success ml-1">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="isModalFormVisible">
            <div class="w-full h-full opacity-65 bg-white bg-opacity-75 m-minusLeftDown z-20 fixed" >
                <div class="bg-white">
                    <div class="border-2 rounded border-solid my-2 top-calcModalFormTop left-calcModalFormLeft fixed bg-white bg-opacity-100">
                        <div class="p-10">

                            <p v-if="errors.length">
                                <b>Please correct the following error(s):</b>
                                <h6 v-for="error in errors">{{ error }}</h6>
                            </p>

                            <div>
                                <div class="flex justify-end mt-1">
                                    <button type="button" name="button" class="btn btn-danger py-0.5 px-2" @click="closeModalForm">X</button>
                                </div>
                                <!-- <h3 class="text-center">Add a Product to a quote</h3> -->
                                <div class="row justify-center">
                                    <div>
                                        <form method="post" @submit.prevent="create">
                                            <input type="hidden" name="_token" :value="csrf">

                                            <div class="form-group">

                                                <label>Select a Quote</label>
                                                <select class="form-control mt-2" name="quote_id" id="quote_id" v-model="formData.quote_id">
                                                    <option v-for="quote in quotesFormData.customer" :key="quote.id" :value="quote.id">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

                    <div class="w-full flex">
                        <div class=" text-center my-2 w-full">
                            <div class="p-3">
                                <h3 class="mb-1">Add Products</h3>
                                <button type="button" name="button" class="btn btn-success" @click="showModalForm">Add</button>
                                <!-- <router-link :to="{ name: 'quotesProductCreate' }" class="btn btn-success">Add</router-link> -->
                            </div>
                        </div>
                    </div>

                    <div v-if="quotes.quoteProduct.length !== 0">
                        <div class="w-full flex flex-wrap">
                            <div class="col-md-4 px-1" v-for="quote in quotes.quoteProduct">
                                <div class="border-2 rounded border-solid my-2 w-full">
                                    <div class="w-full">
                                        <div class="flex justify-end mt-1">
                                            <button type="button" name="button" class="btn btn-danger py-0.5 px-2 mr-2" @click="destroyQuoteProduct(quote.id)">X</button>
                                        </div>
                                        <div class="px-3 pb-3">
                                            <h4 class="mb-2 text-xl text-center">{{ quote.productname }}</h4>
                                            <p class="mb-2 leading-4 text-center">{{ quote.description }}</p>
                                            <h6 class="mb-3 text-center">${{ quote.price }}</h6>
                                            <div>
                                                <quantityCounter v-model:input="quote.quantity" v-bind:quantity="quote.quantity" v-on:input="quote.quantity=$event" v-on:increment-quantity='quote.quantity++' v-on:decrement-quantity="quote.quantity--"></quantityCounter>
                                            </div>

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
                                    <div class="flex justify-center my-2">
                                        <button class="btn-lg btn-success" type="submit" name="button" @submit.prevent="updateQuantities" @click="showModal">Complete</button>
                                    </div>

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
                isModalVisible: false,
                isModalFormVisible: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                quotesFormData: [],
                products: [],
                errors: [],
                formData: {
                    quote_id: null,
                    product_id: null,
                    quantity: ""
                }
            }
        },
        created(id) {
            axios.get(`/api/quotes/${this.$route.params.id}`).then(response => {
                this.quotes = response.data;
            })
            .catch(function() {
                alert('cannot load quote Information')
            });
        },
        methods: {
            showModal() {
                this.isModalVisible = true;
            },
            showModalForm(){
                this.isModalFormVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            },
            closeModalForm() {
                this.isModalFormVisible = false;
            },
            updateQuantities(id){
                this.axios.post(`/api/quoteProduct/update/${this.$route.params.id}`, this.formData)
                    .then((response) => {
                        this.$router.push({
                            name: `showQuote/${id}`
                        });
                        console.log("Quantity CHanged");
                    });
            },
            destroyQuoteProduct(id) {
                this.axios.delete(`/api/quoteproduct/delete/${id}`)
                .then(response => {
                    let i = this.quotes.quoteProduct.map(item => item.id).indexOf(id);
                    this.quotes.quoteProduct.splice(i, 1);
                    console.log('QuoteProduct deleted', `${id}`);
                })
                .catch((errors) => {
                    console.log(errors)
                })
            },

            checkForm(e){
                    if (this.quote_id && this.product_id && this.quantity) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.quote_id) {
                        this.errors.push('Quote required.');
                    }
                    if (!this.product_id) {
                        this.errors.push('Product required.');
                    }
                    if (!this.quantity) {
                        this.errors.push('Quantity required.');
                    }

                    e.preventDefault();
                    create();
            },

            create() {
                axios.post('/api/quoteproduct/store', this.formData)
                .then((response) => {
                    console.log('Quote Product Created');
                    this.formData.quote_id = null;
                    this.formData.product_id = null;
                    this.formData.quantity = "";
                    // this.isModalFormVisible = false;
                })
                .catch((error) => {
                    console.log(error)
                });
            },
            getQuote(){
                axios.get(`/api/quotes/${this.$route.params.id}`).then(response => {
                    this.quotesFormData = response.data;
                })
            },
            getProduct(){
                axios.get('/api/products').then(response => {
                    this.products = response.data;
                })
            },
        },
        mounted() {
            this.getQuote();
            this.getProduct();
        },
        watch: {

        },
        computed: {
            total: function(){
                let totalArray = [];

                for (var i = 0; i < this.quotes.quoteProduct.length; i++) {
                    let allTotals = ((this.quotes.quoteProduct[i].price) * (this.quotes.quoteProduct[i].quantity));
                    totalArray.push(allTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfTotals = totalArray.reduce(reducer);
                return sumOfTotals.toFixed(2)
            },
            subtotal: function(){
                let subTotalArray = [];

                for (var i = 0; i < this.quotes.quoteProduct.length; i++) {
                    let allSubTotals = (((this.quotes.quoteProduct[i].price) * (this.quotes.quoteProduct[i].quantity)) - ((this.quotes.quoteProduct[i].price) * 0.20) * (this.quotes.quoteProduct[i].quantity));
                    subTotalArray.push(allSubTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfSubTotals = subTotalArray.reduce(reducer);
                return sumOfSubTotals.toFixed(2)
            },
            vat(){
                let vatArray = [];

                for (var i = 0; i < this.quotes.quoteProduct.length; i++) {
                    let vatTotals = ((this.quotes.quoteProduct[i].price) * 0.20) * (this.quotes.quoteProduct[i].quantity);
                    vatArray.push(vatTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfVat = vatArray.reduce(reducer);
                return sumOfVat.toFixed(2)
            }
        }
    }
</script>
