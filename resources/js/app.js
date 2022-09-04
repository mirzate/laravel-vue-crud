require('./bootstrap')

import './styles/app.css';

import { createApp } from 'vue'
import router from './router';
import App from './App.vue';

import VueAxios from 'vue-axios';
import axios from 'axios';
import VueFeather from 'vue-feather';

const app = createApp(App)


app.component(VueFeather.name, VueFeather);
app.use(router);
app.use(VueAxios, axios);

app.mount('#app')