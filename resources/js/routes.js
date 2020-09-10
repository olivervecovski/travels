import Main from './components/Main.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
import TripList from './components/Trips/TripList';
import Home from './components/Home';
import LoginProvider from './components/Login/LoginProvider.vue';
import ForgotPassword from './components/Login/ForgotPassword.vue';
import ResetPassword from './components/Login/ResetPassword.vue';
import VerifyEmail from './components/Login/VerifyEmail.vue';
import ViewProfile from './components/User/View_profile.vue';
import store from './store/index';

function redirectIfLoggedIn(to, from, next) {
    if(!localStorage.getItem('token')){
        next();
    } else {
        next('/');
    }
}

function redirectIfNotLoggedIn(to, from, next) {
    if(localStorage.getItem('token'))
        next()
    else
        next('/')
}

function haveToken(to, from, next) {
    to.query.token ? next() : next('/')
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
    {
        path: '/forgot-password',
        component: ForgotPassword,
        beforeEnter: redirectIfLoggedIn
    },
    {
        path: '/reset-password',
        component: ResetPassword,
        beforeEnter: haveToken
    },
    {
        path: '/verify-email',
        component: VerifyEmail,
        beforeEnter: redirectIfLoggedIn
    },
    {
        path: '/profile/:id',
        component: ViewProfile,
        beforeEnter: redirectIfNotLoggedIn
    }
    
    
];