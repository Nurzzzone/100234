export default {
    state: {
        collection: [],
        columns: [],
        filters: [],
        tools: {},
        searchKeyword: "",
        filtersQueryParams: {},
    },
    getters: {
        getTools: state => state.tools,
        getColumns: state => state.columns,
        showFilters: state => state.filters.length > 0,
        getCollection: state => state.collection,
        isPaginationEnabled: state => state.tools.paginationEnabled,
        isButtonsEnabled: state => state.tools.buttonsEnabled,
        isEditEnabled: state => state.tools.editEnabled,
        getEditUrl: state => state.tools.editUrl,
        isDeleteEnabled: state => state.tools.deleteEnabled,

        getFilters(state) {
            for (let filter of state.filters) {
                filter.options = {"": "Все", ...filter.options}
            }

            return state.filters;
        },

        getObjects(state, getters) {
            return getters.isPaginationEnabled? getters.getPaginationObjects: getters.getCollection
        }
    },
    mutations: {
        setTools: (state, value) => state.tools = value,
        setColumns: (state, value) => state.columns = value,
        setFilters: (state, value) => state.filters = value,
        setCollection: (state, value) => state.collection = value,
        setSearchKeyword: (state, value) => state.searchKeyword = value,
        setFiltersQueryParam: (state, { key, value }) => state.filtersQueryParams[key] = value,
        resetFiltersQueryParam: (state) => state.filtersQueryParams = {},
    },

    actions: {
        updatePaginationInstance({ commit, state, getters }, url = undefined) {
            url = url ?? getters.getTableTools.searchUrl ?? location.href;

            return axios.get(url, {
                params: {
                    filters: state.filtersQueryParams,
                    searchKeyword: state.searchKeyword,
                    perPage: getters.getActivePerPageButton,
                }
            }).then((response) => commit('setPaginationInstance', response.data));
        },

        updateToggle(commit, {url, columnName, toggleValue}) {
            if (! url) {
                throw 'Please add "getUpdateToggleUrlAttribute" method and "updateToggleUrl" into "$appends" property on your model!'
            }

            return axios.get(url, {
                params: {
                    [columnName]: toggleValue
                }
            });
        }
    }
}
