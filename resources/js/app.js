require('./bootstrap')

import './styles/app.css';

import { createApp } from 'vue'
import router from './router';
import App from './App.vue';

import VueAxios from 'vue-axios';
import axios from 'axios';


const app = createApp(App)



app.use(router);
app.use(VueAxios, axios);

app.mount('#app')