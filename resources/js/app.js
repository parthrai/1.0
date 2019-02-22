
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import {store} from './store/index'
import VueRouter from 'vue-router'
import VuejsDialog from 'vuejs-dialog'
import Notifications from 'vue-notification'
import VueGoogleCharts from 'vue-google-charts'

import Builder from 'vuse'




import routes from './routes'

Vue.use(VueRouter)
Vue.use(VuejsDialog)
Vue.use(Notifications)
Vue.use(VueGoogleCharts)

Vue.use(Builder)



const router = new VueRouter({
    routes
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('index-loader', require('./components/Index-loader.vue'));

Vue.component('example-component', require('./components/ExampleComponent.vue'));


// Initial Setup


Vue.component('setup-loader-component', require('./components/Initials/loader.vue'));
Vue.component('setup-component', require('./components/Initials/setup/setup.vue'));
Vue.component('addUsers-component', require('./components/Initials/users/addUsers.vue'));


Vue.component('builder-component', require('./components/builder/builder.vue'));
Vue.component('new-component', require('./components/builder/new.vue'));







const app = new Vue({
    el: '#app',
    router,
    store
});
