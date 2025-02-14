import './styles/vue.css';
import 'jquery';
import 'bootstrap';
import 'simplebar';
import waypoint from 'waypoints/lib/jquery.waypoints.js';
import 'node-waves';
import 'classnames';
import './js/app.min';
import './etat_actuel_prod';

import { createApp } from 'vue'; // Utiliser createApp pour Vue 3
import App from './components/App.vue';
import pinia from './plugins/pinia';
import router from './router'; // Importez le router

const app = createApp(App)
app.use(pinia)
app.use(router); // Utilisez le router
app.mount('#app'); // Monter l'application Vue