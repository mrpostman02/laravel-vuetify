require('./bootstrap');

import Vue from 'vue';
import vuetify from './vuetify'
import router from './routes';

Vue.component('app-template', require('./components/Template.vue').default);

const app = new Vue({
    router,
    vuetify
}).$mount('#app');

