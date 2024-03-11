import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

// Importa l'array di rotte dal file route.js
import routes from './route.js' 

// General
import './style.scss'
import App from './App.vue'

// Routes
const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')
