import AppHeader from './components/AppHeader.vue'
import App from './components/AppHeader.vue'

import Home from './components/Home.vue'
import Restaurants from './components/Restaurants.vue'

export default [
    { path: '/', component: Home, name: 'Home' },
    { path: '/restaurants', component: Restaurants, name: 'Restaurants' },
    /* { path: '/details', component: Details, name: 'Details' } */
]