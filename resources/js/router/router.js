import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Dashboard from '../components/Dashboard.vue';
import Details from '../components/Details.vue';
import store from '../store/store';


const routes = [
    {
        path:'/',
        name:'Login',
        component:Login
    },

    {
        path:'/register',
        name:'Register',
        component:Register
    },

    {
        path:'/dashboard/:offset',
        name:'Dashboard',
        component:Dashboard,
        meta: {requiresAuth: true}
    },

    {
        path:'/details/:name',
        name:'Details',
        component:Details,
        meta: {requiresAuth: true}
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('user_id')) {
        next({name: 'Login'});
    } else {
        next();
    }
});

export default router;