require('./bootstrap');

import Vue from 'vue'
import App from './components/App.vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueToast from 'vue-toast-notification';
Vue.use(VueToast, {
    position: 'top',
    pauseOnHover: true
});
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)

import routes from './routes'
import VueSweetalert2 from 'vue-sweetalert2';
import 'vue-toast-notification/dist/theme-default.css';

Vue.use(VueSweetalert2);
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component('nav-bar', require('./components/layout/TopNavBar').default)

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
});


