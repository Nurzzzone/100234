export default {
    state: {
        pagination: {},
        perPageButtons: [
            {value: 10, active: true},
            {value: 20, active: false},
            {value: 50, active: false},
            {value: 100, active: false},
        ]
    },
    getters: {
        getPaginationInstance(state) {
            return state.pagination;
        },
        getPaginationObjects(state) {
            return state.pagination.data;
        },
        getActivePerPageButton(state) {
            return state.perPageButtons.find((button) => button.active).value;
        },
        showPerPageButton(state) {
            return state.pagination.total > 10;
        },
    },
    mutations: {
        setPagination(state, value) {
            state.pagination = value;
        },
        setPerPageQuantity(state, value) {
            state.perPageButtons.forEach(function(button) {
                button.active = button.value === value;
            });
        }
    }
}
