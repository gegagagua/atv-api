import { createRouter, createWebHistory } from 'vue-router';
import Index from '../pages/Index.vue';
import FindATVs from '../pages/FindATVs.vue';
import SellMyATV from '../pages/SellMyATV.vue';
import Research from '../pages/Research.vue';
import ATVDealers from '../pages/ATVDealers.vue';
import Blog from '../pages/Blog.vue';
import Login from '../pages/Login.vue';
import Signup from '../pages/Signup.vue';
import Contact from '../pages/Contact.vue';
import About from '../pages/About.vue';
import Terms from '../pages/Terms.vue';
import Privacy from '../pages/Privacy.vue';
import NotFound from '../pages/NotFound.vue';

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index,
    },
    {
        path: '/find-atvs',
        name: 'FindATVs',
        component: FindATVs,
    },
    {
        path: '/sell-my-atv',
        name: 'SellMyATV',
        component: SellMyATV,
    },
    {
        path: '/research',
        name: 'Research',
        component: Research,
    },
    {
        path: '/atv-dealers',
        name: 'ATVDealers',
        component: ATVDealers,
    },
    {
        path: '/blog',
        name: 'Blog',
        component: Blog,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/signup',
        name: 'Signup',
        component: Signup,
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact,
    },
    {
        path: '/about',
        name: 'About',
        component: About,
    },
    {
        path: '/terms',
        name: 'Terms',
        component: Terms,
    },
    {
        path: '/privacy',
        name: 'Privacy',
        component: Privacy,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

