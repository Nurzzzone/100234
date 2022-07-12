import Vue from 'vue'
import Vuex from 'vuex'
import table from './modules/table'
import pagination from './modules/pagination'
import form from './modules/form'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        table,
        pagination,
        form,
    },
});
