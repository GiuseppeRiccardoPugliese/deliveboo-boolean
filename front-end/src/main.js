import { createApp } from 'vue'
import './style.scss'
import App from './App.vue'

//Importo le rotte
import { router } from './router';

createApp(App).use(router).mount('#app');
