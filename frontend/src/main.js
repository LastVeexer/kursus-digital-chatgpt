import './assets/main.css';

// Vue.config.devtools = false;
// Vue.config.productionTip = false;

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';

// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

const app = createApp(App);

// Menggunakan Pinia dan Router
app.use(createPinia());
app.use(router);

// Mount aplikasi ke elemen dengan id #app
app.mount('#app');
