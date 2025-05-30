import { createApp } from 'vue';
import App from '../components/App.vue'; // ← components にあるApp.vueを指定

import axios from 'axios';
axios.defaults.withCredentials = true;

const app = createApp(App);
app.mount('#app');