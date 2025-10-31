import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/About.vue';
import Dashboard from '../components/Dashboard.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/about',
        name: 'About',
        component: About,
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

