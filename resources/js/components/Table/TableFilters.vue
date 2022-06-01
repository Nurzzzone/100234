<template>
    <div v-if="showTableFilters" class="modal" id="filters"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <table class="table table-responsive-sm table-bordered border-top-0 mb-0">
                        <tbody>
                        <tr v-for="(filter, index) in this.getTableFilters" v-if="filter.type === 'dropdown'" :key="index">
                            <th class="align-middle">{{ filter.label }}</th>
                            <td>
                                <select class="form-control" @input="setQueryParam(filter.paramName, $event.target.value)">
                                    <option v-for="(option, index) in filter.options" :key="index" :value="index">{{ option }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr v-else-if="filter.type === 'radio'" :key="index">
                            <th class="align-middle">{{ filter.label }}</th>
                            <td>
                                <div v-for="(option, index) in filter.options" :key="index" class="form-check">
                                    <input @input="setQueryParam(filter.paramName, $event.target.value)"
                                           class="form-check-input"
                                           name="filter.paramName"
                                           type="radio"
                                           :id="option"
                                           :value="index">
                                    <label class="form-check-label" :for="option">
                                        {{ option }}
                                    </label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button @click.prevent="update"
                            type="button"
                            class="btn btn-outline-dark mt-2 float-right"
                            data-dismiss="modal">Применить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "TableFilters",
    computed: {
        ...mapGetters([
            'getTableFilters',
            'showTableFilters'
        ])
    },
    methods: {
        update() {
            this.$store.dispatch('updatePaginationInstance')
        },
        setQueryParam(key, value) {
            this.$store.commit('setFiltersQueryParam', { key, value })
        }
    }
}
</script>
