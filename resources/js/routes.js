import Main from './components/Main.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
export const routes = [
    { path: '/login', component: Login, name: 'Login' },
    { path: '/register', component: Register, name: 'Register' },
];