import Main from './components/Main.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
import TripList from './components/Trips/TripList';
import store from './store/index';

function redirectIfLoggedIn(to, from, next) {
    if(!localStorage.getItem('token')){
        next();
    } else {
        next('/');
    }
}

export const routes = [
    { path: '/', component: TripList, name: 'Trips'},
    { path: '/login', component: Login, name: 'Login', beforeEnter: redirectIfLoggedIn },
    { path: '/register', component: Register, name: 'Register', beforeEnter: redirectIfLoggedIn },
];