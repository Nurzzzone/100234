import store from "./store"

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-table', require('./components/Table/Table.vue').default);
Vue.component('v-table-head', require('./components/Table/TableHead.vue').default);
Vue.component('v-table-body', require('./components/Table/TableBody.vue').default);
Vue.component('v-table-data', require('./components/Table/TableData.vue').default);
Vue.component('v-table-tools', require('./components/Table/TableTools.vue').default);
Vue.component('v-pagination', require('./components/Pagination/Pagination.vue').default);
Vue.component('v-sidebar-search', require('./components/Sidebar/SidebarSearch.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
new Vue({
    el: '#app',
    store
});
