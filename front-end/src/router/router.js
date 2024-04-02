import { createRouter, createWebHistory } from 'vue-router';

import Home from '../components/Home.vue'
import Login from '../components/Login.vue'
import Restaurants from '../components/Restaurants.vue'
import Details from '../components/Details.vue'
import Carousel from '../components/Carousel.vue'
import Payment from '../components/Payment.vue'
import ThankYou from '../components/ThankYou.vue'
import NotFound from '../components/NotFound.vue'

// Routes
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Carousel,
            name: 'Carousel'
        },
        {
            path: '/home',
            component: Home,
            name: 'Home'
        },
        {
            path: '/restaurants',
            component: Restaurants,
            name: 'Restaurants'
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/details:index/:restaurantName',
            component: Details,
            name: 'Details'
        },
        {
            path: '/payment',
            component: Payment,
            name: 'Payment'
        },
        {
            path: '/thank-you',
            component: ThankYou,
            name: 'ThankYou'
        },
        {
            path: '/:catchAll(.*)',
            component: NotFound,
            name: 'NotFound',
        }

    ]
})


export default router