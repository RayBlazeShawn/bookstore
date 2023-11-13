import { createApp } from 'vue';
import App from './components/App.vue';
import '../css/app.css';
import router from '../router';


const app = createApp(App);
app.use(router); // Use the router
app.mount('#app');

