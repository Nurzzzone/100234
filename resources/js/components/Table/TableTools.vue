<template>
    <div>
        <div class="d-flex">
            <div v-if="this.getTools.searchEnabled" class="input-group mb-2 w-100">
                <input type="text"
                       class="form-control"
                       placeholder="Поиск..."
                       @input="setSearchKeyword($event.target.value)"
                       :value="searchKeyword"
                       @keypress.enter="fireSearch"
                >
                <div class="input-group-append">
                    <button @click="fireSearch" id="search-button" class="btn btn-outline-dark search" type="button">
                        <i id="search-icon" class="cil-search"></i>
                        <span id="loader-icon" class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only"></span>
                        </span>
                    </button>
                </div>
            </div>

            <button v-if="this.showFilters"
                    id="filtersButton"
                    type="button"
                    class="btn btn-outline-dark h-100 ml-2"
                    data-toggle="modal"
                    data-target="#filters"><i class="cil-apps "></i>
            </button>
        </div>

        <div v-if="showPerPageButton" class="dropdown d-inline-block">
            <button class="btn btn-outline-dark dropdown-toggle"
                    role="button"
                    id="perPageDropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"><span>кол-во элементов: {{ getActivePerPageButton }}</span>
            </button>

            <div class="dropdown-menu w-100 mt-1" aria-labelledby="perPageDropdown">
                <button v-for="button in getPerPageButtons"
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
import { mapGetters, mapState, mapMutations, mapActions } from 'vuex';

export default {
    name: "TableTools",
    components: { TableFilters },
    computed: {
        ...mapState({
            searchKeyword: state => state.table.searchKeyword,
        }),
        ...mapGetters([
            'getTools',
            'getPerPageButtons',
            'getActivePerPageButton',
            'showPerPageButton',
            'showFilters',
        ]),
    },
    methods: {
        ...mapMutations([
            'setSearchKeyword',
            'setPerPageQuantity',
        ]),

        ...mapActions([
            'updatePaginationInstance'
        ]),

        changePerPageItems(quantity) {
            this.setPerPageQuantity(quantity);
            this.updatePaginationInstance();
        },

        fireSearch() {
            document.getElementById('loader-icon').style.display = 'block';
            document.getElementById('search-icon').style.display = 'none';

            this.updatePaginationInstance().finally(() => {
                document.getElementById('loader-icon').style.display = 'none';
                document.getElementById('search-icon').style.display = 'block';
            });
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

#filtersButton:hover, #filtersButton:active {
    color: #636f83 !important;
    border-color: #768192 !important;
}

.dropdown-item:active, .dropdown-item:hover, .dropdown-item:focus {
    background-color: #ebedef !important;
    color: #636f83 !important;
}

#loader-icon {
    color: #a9b7cf!important;
    display: none;
}

#search-button {
    border-color: #d8dbe0 !important;
}

#search-button:hover, #search-button:active, #search-button:focus {
    border-color: #768192 !important;
}

</style>
