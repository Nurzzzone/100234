<template>
    <div>
        <div v-if="tableConfig.searchEnabled" class="search-input position-relative mb-2">
            <input v-model="searchObjectsInput" type="text" class="form-control" placeholder="Поиск...">
            <div id="loader-wrapper" class="position-absolute mr-3">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>

        <div v-if="this.$parent.getPaginationLinksCount() > 10 && tableConfig.perPageButtonEnabled" class="dropdown">
            <button class="btn btn-outline-dark dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                кол-во элементов: {{ getActivePerPageButton() }}
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <button v-for="button in perPageButtons"
                        @click="changePerPageItems(button.value)"
                        class="dropdown-item"
                        :disabled="button.active">{{ button.value }}</button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "TableTools",
    data() {
        return {
            searchObjectsInput: this.$parent.searchKeyword,
            tableConfig: this.$parent.tableConfig.tools,
            url: this.$parent.tableConfig.tools.searchUrl,
            perPageButtons: [
                {value: 10, active: true},
                {value: 20, active: false},
                {value: 50, active: false},
                {value: 100, active: false},
            ],
        }
    },
    watch: {
        'searchObjectsInput': {
            handler: function() {
                document.getElementById('loader-wrapper').style.display = 'block';

                this.fireDelayedSearch();
            }
        }
    },
    methods: {
        fireDelayedSearch: _.debounce(function() {
            axios.get(String(this.url), {
                params: {
                    searchKeyword: this.searchObjectsInput,
                    perPage: this.getActivePerPageButton()
                }
            }).then((response) => {
                this.$parent.updatePaginationInstance(response.data);
                this.$parent.searchKeyword = this.searchObjectsInput;
            }).finally(() => {
                document.getElementById('loader-wrapper').style.display = 'none';
            });
        }, 1500),

        changePerPageItems(quantity) {
            this.$parent.perPage = quantity;
            this.$parent.searchKeyword = this.searchObjectsInput;

            axios.get(String(this.url), {
                params: {
                    searchKeyword: this.searchObjectsInput,
                    perPage: quantity,
                }
            }).then((response) => {
                this.$parent.updatePaginationInstance(response.data);

                this.perPageButtons.forEach(function(button) {
                    button.active = button.value === quantity;
                })
            });
        },

        getActivePerPageButton() {
            return this.perPageButtons.find((button) => button.active).value;
        }
    }
}
</script>

<style scoped>
.dropdown .btn, .btn:focus, .btn:hover, .btn:active {
    color: #636f83 !important;
    border-color: #d8dbe0 !important;
    background-color: #ffffff !important;
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
