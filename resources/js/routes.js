import Main from './components/Main.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
import TripList from './components/Trips/TripList';
import Home from './components/Home';
import store from './store/index';

function redirectIfLoggedIn(to, from, next) {
    if(!localStorage.getItem('token')){
        next();
    } else {
        next('/');
    }
}

export const routes = [
    { 
        path: '/',
        component: Home,
        name: 'Home'
    },
    { 
        path: '/signin', 
        component: Login, name: 'Login',
        beforeEnter: redirectIfLoggedIn
    },
    { 
        path: '/signup',
        component: Register, name: 'Register',
        beforeEnter: redirectIfLoggedIn
    },
    {
        path: '/auth/:provider/callback',
        name: 'login',
        component: LoginProvider,
        beforeEnter: redirectIfLoggedIn
    },
    
];