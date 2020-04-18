/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import axios from 'axios';
//Load for router
import router from './router'
import store from './store'
import utils from './mixins/Utils' 

window.Vue = require('vue');
Vue.mixin(utils);
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('side-tickets-component', require('./components/SideTicketsComponent.vue').default);
Vue.component('side-suggest-link-component', require('./components/SideSuggestLinkComponent.vue').default);

Vue.component('loading-component', require('./components/LoadingComponent.vue').default);
Vue.component('link-card-component', require('./components/LinkCardComponent.vue').default);
Vue.component('date-event-modal-component', require('./components/DateEventModalComponent.vue').default);
Vue.component('pagination-component', require('./components/PaginationComponent.vue').default);
Vue.component('tweet-component', require('./components/TweetComponent.vue').default);
Vue.component('event-lists-component', require('./components/EventListsComponent.vue').default);
Vue.component('cast-lists-component', require('./components/CastListsComponent.vue').default);
Vue.component('input-suggest-component', require('./components/InputSuggestComponent.vue').default);
Vue.component('calendar-component', require('./components/CalendarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store),
    router
});
