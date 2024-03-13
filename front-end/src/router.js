import AppHeader from './components/AppHeader.vue'
import App from './components/AppHeader.vue'

import Home from './components/Home.vue'
import Login from './components/Login.vue'
import Restaurants from './components/Restaurants.vue'
import Details from './components/Details.vue'

export default [
    { path: '/', component: Home, name: 'Home' },
    { path: '/restaurants', component: Restaurants, name: 'Restaurants' },
    { path: '/login', component: Login, name: 'Login' },
    { path: '/details:index', component: Details, name: 'Details' }
]