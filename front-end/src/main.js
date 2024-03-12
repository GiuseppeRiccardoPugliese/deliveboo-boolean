import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

// Importa l'array di rotte dal file route.js
import routes from './router.js'

// General
import './style.scss'
import App from './App.vue'

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Routes
const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')
