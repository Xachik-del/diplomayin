/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import router from './router/router.js'
import App from './App.vue'
import store from './store';

require('./bootstrap');



const app = new Vue({
    el: '#app',
    components: {
        App
    },
    // render: app => app(App),
    router,
    store,
});
