/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import axios from 'axios';
import store from "./store";
import VueRouter from 'vue-router'
import User from './Helpers/User'
require('./bootstrap');

window.Vue = require('vue');

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

Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes
});

let isRefreshing = false;

// axios.interceptors.response.use(
//     response => {
//         return response;
//     },
//     err => {
//         const {
//             config,
//             response: { status, data }
//         } = err;
//         if(status === 401 && data.message === "Unauthenticated") {
//             if(!isRefreshing) {
//                 isRefreshing = true;
//                 User.refresh()
//                 .then(response => {
//                     console.log(response);
//                 })
//             }
//         }
//     }
// )

const app = new Vue({
    el: '#app',
    router,
    store
});
