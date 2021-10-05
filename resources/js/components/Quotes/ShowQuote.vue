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
                                    <button type="button" name="button" class="btn btn-success ml-1" @click="addDataToDatabase">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="isModalFormVisible">
            <div class="w-full h-full opacity-65 bg-white bg-opacity-75 m-minusLeftDown z-20 fixed">
                <div class="bg-white">
                    <div class="border-2 rounded border-solid my-2 top-calcModalFormTop left-calcModalFormLeft fixed bg-white bg-opacity-100">
                        <div class="p-10">

                            <p v-if="this.lengthOfErrors === true">
                                <b>Please correct the following error(s):</b>
                                <h6 v-for="error in errors">{{ error }}</h6>
                            </p>

                            <div>
                                <div class="flex justify-end mt-1">
                                    <button type="button" name="button" class="btn btn-danger py-0.5 px-2" @click="closeModalForm">X</button>
                                </div>

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

                    <div class="w-full flex" v-if="this.lengthOfProducts === 0">
                        <div class=" text-center my-2 w-full">
                            <div class="p-3">
                                <h3 class="mb-1">Add Products</h3>
                                <button type="button" name="button" class="btn btn-success" @click="showModalForm">Add</button>
                            </div>
                        </div>
                    </div>

                    <div v-if="this.lengthOfProducts !== 0">
                        <div class="w-full flex flex-wrap">
                            <div class="col-md-4 px-1" v-for="product in quotes.quoteProduct">

                                <div class="border-2 rounded border-solid my-2 w-full">
                                    <div class="w-full">
                                        <div class="px-3 py-3">
                                            <h4 class="mb-2 text-xl text-center">{{ product.productname }}</h4>
                                            <p class="mb-2 leading-4 text-center">{{ product.description }}</p>
                                            <h6 class="mb-3 text-center">${{ product.price }}</h6>
                                            <h6 class="mb-3 text-center">Quantity: {{ product.quantity }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="this.lengthOfData !== 0">
                        <div class="w-full flex flex-wrap">
                            <div class="col-md-4 px-1" v-for="(product, index) in sendData" :key="index">
                                <div class="border-2 rounded border-solid my-2 w-full">

                                    <div class="w-full">
                                        <div class="flex justify-end mt-1">
                                            <button type="button" name="button" class="btn btn-danger py-0.5 px-2 mr-2" @click="removeVueProduct(index)">X</button>
                                        </div>
                                        <div v-for="i in products">
                                            <div class="px-3 pb-3" v-if="product.product_id === i.id">

                                                <h4 class="mb-2 text-xl text-center">{{ i.name }}</h4>
                                                <p class="mb-2 leading-4 text-center">{{ i.description }}</p>
                                                <p class="mb-2 leading-4 text-center">${{ i.price }}</p>
                                                <div>
                                                    <quantityCounter v-model:input="product.quantity" v-bind:quantity="product.quantity" v-on:input="product.quantity=$event" v-on:increment-quantity='product.quantity++' v-on:decrement-quantity="product.quantity--"></quantityCounter>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 rounded border-solid w-full my-2">
                        <div class="container">
                            <div class="p-3">
                                <div v-if="this.lengthOfProducts !== 0">
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

                                <div v-else>
                                    <div class="flex flex-row justify-between">
                                        <h6 class="my-2 block">VAT(20%): </h6>
                                        <h6 class="my-2 block">${{ vatVUE }}</h6>
                                    </div>

                                    <div class="flex flex-row justify-between">
                                        <h6 class="my-2 block">Subtotal: </h6>
                                        <h6 class="my-2 block">${{ subtotalVUE }}</h6>
                                    </div>
                                    <hr>
                                    <div class="flex flex-row justify-between">
                                        <h6 class="my-2 block">Total: </h6>
                                        <h6 class="my-2 block">${{ totalVUE }}</h6>
                                    </div>
                                </div>


                                <div class="flex justify-center my-2" v-if="this.lengthOfData !== 0">
                                    <button class="btn-lg btn-success" type="submit" name="button" @click="showModal">Complete</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center my-2" v-if="quotes.customer[0].order_complete === 1">
                        <button class="btn-lg btn-success">Order Complete</button>
                    </div>

                    <div class="alert alert-danger" role="alert" v-for="error in errors">
                        {{ error }}
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
                },
                sendData: [],
                complete: {
                    order_complete: [
                        true
                    ],
                },
                // emailData: [],
            }
        },
        created(id) {
            this.getQuoteData(id);
        },
        methods: {
            getQuoteData(id) {
                axios.get(`/api/quotes/${this.$route.params.id}`)
                .then(response => {
                    this.quotes = response.data;
                })
                .catch(function() {
                    alert('cannot load quote Information')
                });
            },
            sendEmail() {
                axios.get(`/email/${this.$route.params.id}`)
                .then(response => {
                    this.emailData = response.data;
                    this.isModalVisible = false;
                })
            },
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

            // destroyQuoteProduct(id) {
            //     let i = this.sendData.map(item => item.id).indexOf(id);
            //     this.sendData.splice(i, 1);
            //     console.log('QuoteProduct deleted', `${id}`);
            // },
            removeVueProduct(index){
                this.sendData.splice(index, 1);
            },

            // checkForm(e){
            //         if (this.quote_id && this.product_id && this.quantity) {
            //             return true;
            //         }
            //
            //         this.errors = [];
            //
            //         if (!this.quote_id) {
            //             this.errors.push('Quote required.');
            //         }
            //         if (!this.product_id) {
            //             this.errors.push('Product required.');
            //         }
            //         if (!this.quantity) {
            //             this.errors.push('Quantity required.');
            //         }
            //
            //         e.preventDefault();
            //         this.create();
            // },
            create() {
                this.sendData.push({ ...this.formData });
                this.formData.quote_id = null;
                this.formData.product_id = null;
                this.formData.quantity = "";
                // this.isModalFormVisible = false;
            },

            addDataToDatabase(id){
                axios.post(`/api/quoteproduct/store`, this.sendData)
                .then((response) => {
                    console.log(response);
                    console.log("Products added to database");
                })
                .catch((error) => this.errors = error.response.data);

                axios.post(`/api/quotes/update/${this.$route.params.id}`, this.complete)
                .then((response) => {
                    console.log(response);
                    this.$router.push({name: 'quotes'});
                })
                .catch((error) => this.errors = error.response.data);
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
        watch: {},
        computed: {
            lengthOfData: function(){
                const lengthOfSendDataAdded = this.sendData.length;
                return lengthOfSendDataAdded;
            },
            lengthOfProducts: function(){
                const lengthOfproductsAdded = this.quotes.quoteProduct?.length;
                return lengthOfproductsAdded;
            },
            lengthOfErrors: function(){
                const lengthOfErrorsAdded = this.errors.length;
                return lengthOfErrorsAdded;
            },
            total: function(){
                let totalArray = [0];

                for (var i = 0; i < this.lengthOfProducts; i++) {
                    let allTotals = ((this.quotes.quoteProduct[i].price) * (this.quotes.quoteProduct[i].quantity));
                    totalArray.push(allTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfTotals = totalArray.reduce(reducer);
                return sumOfTotals.toFixed(2)
            },
            subtotal: function(){
                let subTotalArray = [0];

                for (var i = 0; i < this.lengthOfProducts; i++) {
                    let allSubTotals = (((this.quotes.quoteProduct[i].price) * (this.quotes.quoteProduct[i].quantity)) - ((this.quotes.quoteProduct[i].price) * 0.20) * (this.quotes.quoteProduct[i].quantity));
                    subTotalArray.push(allSubTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfSubTotals = subTotalArray.reduce(reducer);
                return sumOfSubTotals.toFixed(2)
            },
            vat: function(){
                let vatArray = [0];

                for (var i = 0; i < this.lengthOfProducts; i++) {
                    let vatTotals = ((this.quotes.quoteProduct[i].price) * 0.20) * (this.quotes.quoteProduct[i].quantity);
                    vatArray.push(vatTotals);
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfVat = vatArray.reduce(reducer);
                return sumOfVat.toFixed(2);
            },


        // VUE Payload totals    -->NEED TO CHANGE THE PRICE TO MATCH<--
            totalVUE: function(){
                let totalArray = [0];

                for (var i = 0; i < this.lengthOfData; i++) {
                    for (var a = 0; a < this.products.length; a++) {
                        if (this.sendData[i].product_id === this.products[a].id) {
                            let allTotals = ((this.products[a].price) * (this.sendData[i].quantity));
                            totalArray.push(allTotals);
                        }
                    }
                }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfTotals = totalArray.reduce(reducer);
                return sumOfTotals.toFixed(2)
            },
            subtotalVUE: function(){
                let subTotalArray = [0];

                for (var i = 0; i < this.lengthOfData; i++) {
                    for (var a = 0; a < this.products.length; a++) {
                        if (this.sendData[i].product_id === this.products[a].id) {
                            let allSubTotals = (((this.products[a].price) * (this.sendData[i].quantity)) - ((this.products[a].price) * 0.20) * (this.sendData[i].quantity));
                            subTotalArray.push(allSubTotals);
                        }
                    }
                }

                // for (var i = 0; i < this.lengthOfData; i++) {
                //     let allSubTotals = (((this.sendData[i].price) * (this.sendData[i].quantity)) - ((this.sendData[i].price) * 0.20) * (this.quotes.quoteProduct[i].quantity));
                //     subTotalArray.push(allSubTotals);
                // }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfSubTotals = subTotalArray.reduce(reducer);
                return sumOfSubTotals.toFixed(2)
            },
            vatVUE: function(){
                let vatArray = [0];

                for (var i = 0; i < this.lengthOfData; i++) {
                    for (var a = 0; a < this.products.length; a++) {
                        if (this.sendData[i].product_id === this.products[a].id) {
                            let vatTotals = ((this.products[a].price) * 0.20) * (this.sendData[i].quantity);
                            vatArray.push(vatTotals);
                        }
                    }
                }

                // for (var i = 0; i < this.lengthOfData; i++) {
                //     let vatTotals = ((this.sendData[i].price) * 0.20) * (this.sendData[i].quantity);
                //     vatArray.push(vatTotals);
                // }

                const reducer = (previousValue, currentValue) => previousValue + currentValue;

                let sumOfVat = vatArray.reduce(reducer);
                return sumOfVat.toFixed(2)
            }
        }
    }
</script>
