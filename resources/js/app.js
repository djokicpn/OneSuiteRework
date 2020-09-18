require('./bootstrap');

import Vue from 'vue'
import App from './components/App.vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import routes from './routes'
import VueSweetalert2 from 'vue-sweetalert2';



Vue.use(VueSweetalert2);
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component('nav-bar', require('./components/layout/TopNavBar').default)

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
});


