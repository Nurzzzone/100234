export default {
    state: {
        pagination: {},
        tableConfig: {
            tools: {},
            columns: [],
            filters: [],
        },
        searchKeyword: "",
        filtersQueryParams: {},
        perPageButtons: [
            {value: 10, active: true},
            {value: 20, active: false},
            {value: 50, active: false},
            {value: 100, active: false},
        ]
    },

    getters: {
        // Получение столбцов
        getTableColumns: state => state.tableConfig.columns,

        // Получение кнопок
        getTableTools: state => state.tableConfig.tools,

        // Получение записей для отображение в таблице
        getTableObjects: state => state.pagination.data,

        // Получение фильтров
        getTableFilters(state) {
            for (let filter of state.tableConfig.filters) {
                filter.options = {"": "Все", ...filter.options}
            }

            return state.tableConfig.filters;
        },

        // Получение кол-во ссылок на страницы
        getPaginationLinksCount(state) {
            return state.pagination.links.slice(1, -1).length;
        },

        getActivePerPageButton(state) {
            return state.perPageButtons.find((button) => button.active).value;
        },

        getPaginationInstance( state) {
            return state.pagination;
        },

        // Отображение кнопки "кол-во элементов"
        showPerPageButton(state, getters) {
            return getters.getPaginationLinksCount > 10 && state.tableConfig.tools.perPageButtonEnabled;
        },

        // Отображение кнопки фильтров и модального окна
        showTableFilters(state, getters) {
            return getters.getTableFilters.length > 0;
        }
    },

    mutations: {
        // Сохранение экземпляра класса
        setPaginationInstance(state, value) {
            state.pagination = value;
        },

        // Сохранение фильтров, кнопок и столбцов для таблицы
        setTableConfig(state, value) {
            state.tableConfig = value;
        },

        setSearchKeyword(state, value) {
            state.searchKeyword = value;
        },

        // Сохранение параметров для запроса нового отфильтрованного списка
        setFiltersQueryParam(state, { key, value }) {
            state.filtersQueryParams[key] = value;
            console.log(state.filtersQueryParams);
        },

        resetFiltersQueryParam(state) {
            state.filtersQueryParams = {};
        },

        setPerPageQuantity(state, value) {
            state.perPageButtons.forEach(function(button) {
                button.active = button.value === value;
            });
        }
    },

    actions: {
        // Получение экземпляра класса LengthAwarePaginator
        updatePaginationInstance({ commit, state, getters }, url = undefined) {
            return axios.get(url ?? getters.getTableTools.searchUrl, {
                params: {
                    filters: state.filtersQueryParams,
                    searchKeyword: state.searchKeyword,
                    perPage: getters.getActivePerPageButton,
                }
            }).then((response) => commit('setPaginationInstance', response.data));
        }
    }
}