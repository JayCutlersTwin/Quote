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
        <button class="btn-sm btn-primary font-lg" @click="$emit('decrement-quantity')" type="button" name="button" v-bind:disabled="quantity<1">-</button>
        <input v-model="count" v-on:input="$emit('input', count)" class="form-control mx-2 w-12" >
        <button class="btn-sm btn-primary font-lg" @click="$emit('increment-quantity')" type="button" name="button">+</button>
    </div>`,
});

// Vue.component('quantityCounter', {
//     props: ['value'],
//         computed: {
//             count: {
//                 get() { return this.value },
//                 set(newValue) { this.$emit('input', newValue) }
//             }
//         },
//     template:
//     `<div class="flex flex-row justify-evenly h-10">
//         <button class="btn-sm btn-primary font-lg" v-on:click="count--" type="button" name="button" v-bind:disabled="count<1">-</button>
//         <input  v-model.number="count" class="form-control mx-2 w-12" >
//         <button class="btn-sm btn-primary font-lg" v-on:click="count++" type="button" name="button">+</button>
//     </div>`,
// });

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});



// Vue.component('', {
//     template: ``,
//     data: function(){
//         return {
//             quantity: 0
//         }
//     },
//     methods: {}
// });

// <div class="flex flex-row justify-evenly h-10">
//     <button class="btn-sm btn-primary font-lg" @click="applyDecrement()" type="button" name="button">-</button>
//     <input v-model="count" v-on:input="$emit('input', count)" class="form-control" >
//     <h6 class="font-bold text-lg p-1.5" >{{ quantity }}</h6>
//     <button class="btn-sm btn-primary font-lg" @click="applyIncrement()" type="button" name="button">+</button>
// </div>

// methods: {
//     applyDecrement(){
//         if(this.quantity === 0) {
//             alert('Negative quantity not allowed')
//         } else {
//             this.$emit('applied-decrement', this.quantity--)
//         }
//     },
//     applyIncrement(){
//         this.$emit('applied-increment', this.quantity++)
//     }
// }
