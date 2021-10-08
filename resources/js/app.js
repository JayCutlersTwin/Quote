import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './route';
import axios from 'axios';
import VueAxios from 'vue-axios';
import './bootstrap';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.component('quantityCounter', {
    props: ['quantity'],
    data: function() {
        return {
            count: this.quantity
        }
    },
    watch: {
        quantity(val) {
            this.count = val;
        }
    },
    template:
    `<div class="flex flex-row justify-evenly h-10">
        <button class="btn-sm btn-primary font-lg" @click="$emit('decrement-quantity')" type="button" name="button" v-bind:disabled="quantity<2">-</button>
        <input v-model="count" v-on:input="$emit('input', count)" class="form-control mx-2 w-12" >
        <button class="btn-sm btn-primary font-lg" @click="$emit('increment-quantity')" type="button" name="button">+</button>
    </div>`,
});

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
