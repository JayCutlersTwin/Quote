<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-lg text-center inline-block">Quotes</h3>
                        <router-link :to="{ name: 'quotesCreate'}" class="float-right inline-block btn-sm btn-success">Add</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table-fixed border-2 rounded border-solid my-2 w-full">
                            <thead>
                                <th class="w-1/3 text-left p-4">Quote Name</th>
                                <th class="w-1/3 text-center p-4">Complete</th>
                                <th class="w-1/3 p-4"></th>
                            </thead>
                            <tbody>
                                <tr v-for="quote in quotes" :key="quote.id">
                                    <td class="text-left p-4">{{ quote.quotename }}</td>

                                    <td class="text-center p-4">
                                        <div v-if="quote.order_complete === 0">
                                            Order Incomplete
                                        </div>
                                        <div v-if="quote.order_complete === 1">
                                            Order Complete
                                        </div>
                                    </td>

                                    <td class="text-right p-4">
                                        <div class="inline-block">
                                            <router-link class="btn btn-primary" :to="{ name: 'quotesShow', params: { id: quote.id }}">View</router-link>
                                        </div>
                                        <div class="inline-block" v-if="quote.order_complete === 0">
                                            <router-link class="btn btn-primary" :to="{ name: 'quotesEdit', params: { id: quote.id }}">Edit</router-link>
                                            <button class="btn btn-danger" @click="destroyQuote(quote.id)">Delete</button>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="card-body" v-for="quote in quotes" :key="quote.id">
                        <div class="container mx-auto">
                            <div class="container mx-auto inline-block p-2 w-full border-2 rounded border-solid relative">
                                <div class="float-left text-lg">
                                    <h4 class="">{{ quote.quotename}}</h4>
                                </div> -->
                                <!-- <div class="float-right">
                                    <router-link class="btn-sm btn-primary" :to="{ name: 'quotesShow', params: { id: quote.id }}">View</router-link>
                                    <router-link class="btn-sm btn-primary" :to="{ name: 'quotesEdit', params: { id: quote.id }}">Edit</router-link>
                                    <button class="btn-sm btn-danger" @click="destroyQuote(quote.id)">Delete</button>
                                </div> -->
                                <!-- <div class="float-right">
                                    <div>
                                        <div class="inline-block">
                                            <div class="inline-block" v-if="quote.order_complete === 0">
                                                X
                                            </div>
                                            <div class="inline-block" v-if="quote.order_complete === 1">
                                                Order Complete
                                            </div>
                                        </div>
                                        <div class="inline-block">
                                            <router-link class="btn-sm btn-primary" :to="{ name: 'quotesShow', params: { id: quote.id }}">View</router-link>
                                        </div>
                                        <div class="inline-block" v-if="quote.order_complete === 0">
                                            <router-link class="btn-sm btn-primary" :to="{ name: 'quotesEdit', params: { id: quote.id }}">Edit</router-link>
                                            <button class="btn-sm btn-danger" @click="destroyQuote(quote.id)">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            quotes: []
        }
    },

    methods: {
        getQuotes(){
            axios.get('/api/quotes').then(response => {
                this.quotes = response.data
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
    },
    mounted() {
        this.getQuotes()
    },
}
</script>
