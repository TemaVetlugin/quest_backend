
import './bootstrap';
import { createApp } from 'vue';
import Index from './components/Index.vue'
import router from "./router.js"


createApp(Index).use(router).mount('#app') //подключение роутера опционально
