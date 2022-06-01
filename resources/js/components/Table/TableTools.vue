<template>
    <div>
        <div class="d-flex">
            <div v-if="getTableTools.searchEnabled" class="search-input position-relative mb-2 w-100">
                <input @change="fireDelayedSearch"
                       type="text"
                       class="form-control"
                       placeholder="Поиск..."
                       :value="searchObjectsInput"
                >

                <div id="loader-wrapper" class="position-absolute mr-3">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>

            <button v-if="showTableFilters"
                    id="filtersButton"
                    type="button"
                    class="btn btn-outline-dark h-100 ml-2"
                    data-toggle="modal"
                    data-target="#filters"><i class="cil-apps "></i>
            </button>
        </div>

        <div v-if="showPerPageButton" class="dropdown">
            <button class="btn btn-outline-dark dropdown-toggle"
                    role="button"
                    id="perPageDropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"><span>кол-во элементов: {{ getActivePerPageButton }}</span>
            </button>

            <div class="dropdown-menu" aria-labelledby="perPageDropdown">
                <button v-for="button in perPageButtons"
                        @click="changePerPageItems(button.value)"
                        class="dropdown-item"
                        :disabled="button.active">{{ button.value }}
                </button>
            </div>
        </div>

        <table-filters></table-filters>
    </div>
</template>

<script>
import TableFilters from "./TableFilters";
import { mapGetters, mapState } from 'vuex';

export default {
    name: "TableTools",
    components: { TableFilters },
    computed: {
        ...mapState({
            searchObjectsInput: state => state.table.searchKeyword,
            perPageButtons: state => state.table.perPageButtons
        }),
        ...mapGetters([
            'getTableTools',
            'getActivePerPageButton',
            'showPerPageButton',
            'showTableFilters',
        ])
    },
    methods: {
        search: _.debounce(function(e) {
            this.$store.commit('setSearchKeyword', e.target.value);

            this.$store.dispatch('updatePaginationInstance').finally(() => {
                document.getElementById('loader-wrapper').style.display = 'none';
            });
        }, 1500),

        fireDelayedSearch(e) {
            document.getElementById('loader-wrapper').style.display = 'block';

            this.search(e);
        },

        changePerPageItems(quantity) {
            this.$store.commit('setPerPageQuantity', quantity);

            this.$store.dispatch('updatePaginationInstance');
        },
    }
}
</script>

<style scoped>
.dropdown .btn, .btn:focus, .btn:hover, .btn:active {
    color: #636f83 !important;
    border-color: #d8dbe0 !important;
    background-color: #ffffff !important;
}
#filtersButton {
    color: #636f83 !important;
    border-color: #d8dbe0 !important;
}

.dropdown-item:active, .dropdown-item:hover, .dropdown-item:focus {
    background-color: #ebedef !important;
    color: #636f83 !important;
}

#loader-wrapper {
    color: #3c4b64 !important;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    display: none;
}
</style>
