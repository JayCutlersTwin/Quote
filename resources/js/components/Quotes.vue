<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-lg text-center inline-block">Quotes</h3>
                        <router-link :to="{ name: 'quotesCreate'}" class="float-right inline-block btn-sm btn-success">Add</router-link>
                    </div>

                    <div class="card-body" v-for="quote in quotes" :key="quote.id">
                        <div class="container mx-auto">
                            <div class="container mx-auto inline-block p-2 w-full border-2 rounded border-solid relative">
                                <div class="float-left text-lg">
                                    <h4 class="">{{ quote.quotename}}</h4>
                                </div>
                                <div class="float-right ">
                                    <router-link class="btn-sm btn-primary" :to="{ name: 'quotesShow', params: { id: quote.id }}">View</router-link>
                                    <router-link class="btn-sm btn-primary" :to="{ name: 'quotesEdit', params: { id: quote.id }}">Edit</router-link>
                                    <button class="btn-sm btn-danger" @click="destroyQuote(quote.id)">Delete</button>
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
