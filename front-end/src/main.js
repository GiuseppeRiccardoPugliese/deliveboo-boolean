import { createApp } from 'vue';
import router from './router/router'

import App from './App.vue';
// Importa l'array di rotte dal file route.js
// import routes from './router.js';

// General
import './style/style.scss';
// import App from './App.vue';

// Importo lo swiper
import 'swiper/swiper-bundle.css';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';



const app = createApp(App)
app.use(router)
app.mount('#app')
