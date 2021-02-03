import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home';
import AboutUs from './components/AboutUs';
import Contact from './components/Contact';

Vue.use(VueRouter);

let routes = [
    //
    {
        path: '/',
        component: Home
    },
    {
        path: '/about',
        component: AboutUs
    },
    {
        path: '/contact',
        component: Contact
    }


];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;



