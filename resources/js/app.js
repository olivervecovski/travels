/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import axios from 'axios';
import store from "./store";
import VueRouter from 'vue-router'
import User from './Helpers/User'
import Toasted from 'vue-toasted'

import { library } from '@fortawesome/fontawesome-svg-core';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';


require('./bootstrap');

window.Vue = require('vue');

library.add(fab);
library.add(fas);
Vue.component('fa', FontAwesomeIcon);

Vue.use(Toasted, {
    iconPack: 'fontawesome'
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-app', require('./components/Main.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { routes } from './routes.js';
import Axios from 'axios';

// const init = async () => {

//     let token = localStorage.getItem('token');
//     if(token) {
//         await store.dispatch('authUser')
//     };
    
    
// }

// init()
Vue.use(VueRouter);
    const router = new VueRouter({
        mode: 'history',
        routes
    });
    
    let isRefreshing = false;
    
    const app = new Vue({
        el: '#app',
        router,
        store
    });