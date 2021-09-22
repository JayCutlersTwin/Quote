import Home from './components/Home';

import Quotes from './components/Quotes';
import ShowQuote from './components/Quotes/ShowQuote';
import EditQuote from './components/Quotes/EditQuote';
import CreateQuote from './components/Quotes/CreateQuote';

import Customers from './components/Customers';
import ShowCustomer from './components/customers/ShowCustomer';
import EditCustomer from './components/customers/EditCustomer';
import CreateCustomer from './components/customers/CreateCustomer';

import Products from './components/Products';
import EditProduct from './components/Products/EditProduct';
import CreateProduct from './components/Products/CreateProduct';

import EditQuoteProduct from './components/quoteProducts/EditQuoteProduct';
import CreateQuoteProduct from './components/quoteProducts/CreateQuoteProduct';

export default {

    mode:'history',

    routes: [
        {
            name: 'home',
            path: '/',
            component: Home
        },

        {
            name: 'quoteProductEdit',
            path: '/quoteproduct/edit/:id',
            component: EditQuoteProduct
        },
        {
            name: 'quotesProductCreate',
            path: '/quoteproduct/create',
            component: CreateQuoteProduct
        },


        //Quotes

        {
            name: 'quotes',
            path: '/quotes',
            component: Quotes
        },
        {
            name: 'quotesShow',
            path: '/quotes/:id',
            component: ShowQuote
        },
        {
            name: 'quotesEdit',
            path: '/quotes/edit/:id',
            component: EditQuote
        },
        {
            name: 'quotesCreate',
            path: '/quotes/create',
            component: CreateQuote
        },

        //Customers

        {
            name: 'customers',
            path: '/customers',
            component: Customers
        },
        {
            name: 'customersShow',
            path: '/customers/:id',
            component: ShowCustomer
        },
        {
            name: 'customersEdit',
            path: '/customers/edit/:id',
            component: EditCustomer
        },
        {
            name: 'customersCreate',
            path: '/customers/create',
            component: CreateCustomer
        },

        // Products

        {
            name: 'products',
            path: '/products',
            component: Products
        },
        {
            name: 'productsEdit',
            path: '/products/edit/:id',
            component: EditProduct
        },
        {
            name: 'productsCreate',
            path: '/products/create',
            component: CreateProduct
        },

    ]
};
