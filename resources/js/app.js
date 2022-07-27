import store from "./store"

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');

Vue.component('v-table', require('./components/Table/Table.vue').default);
Vue.component('v-table-head', require('./components/Table/TableHead.vue').default);
Vue.component('v-table-body', require('./components/Table/TableBody.vue').default);
Vue.component('v-table-data', require('./components/Table/TableData.vue').default);
Vue.component('v-table-tools', require('./components/Table/TableTools.vue').default);
Vue.component('v-pagination', require('./components/Pagination/Pagination.vue').default);
Vue.component('v-sidebar-search', require('./components/Sidebar/SidebarSearch.vue').default);
Vue.component('v-sidebar-dropdown', require('./components/Sidebar/MenuDropdown.vue').default);
Vue.component('v-sidebar-link', require('./components/Sidebar/MenuLink.vue').default);
Vue.component('v-sidebar-title', require('./components/Sidebar/MenuTitle.vue').default);
Vue.component('v-sidebar-menu', require('./components/Sidebar/Menu.vue').default);

Vue.component('v-form', require('./components/Form/Form.vue').default);

new Vue({
    el: '#admin-panel-app',
    store
});
