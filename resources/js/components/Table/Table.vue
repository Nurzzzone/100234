<template>
    <div>
        <div class="card">
            <div class="card-header" v-if="this.getTools.createEnabled">
                <div class="d-flex justify-content-end align-content-center">
                    <a class="btn btn-outline-dark" :href="this.getTools.createUrl">Создать</a>
                </div>
            </div>
            <!-- TableComponent -->
            <div class="card-body">
                <table-tools class="mb-4"></table-tools>
                <table :class="{ 'table-hover': this.getObjects.length > 0 }"
                       class="table table-responsive-sm table-bordered border-top-0 mb-0">
                    <slot>
                        <!-- TableHeadComponent -->
                        <!-- TableBodyComponent -->
                    </slot>
                </table>
            </div>

            <!-- PaginationComponent -->
            <div class="card-footer">
                <v-pagination></v-pagination>
            </div>
        </div>

    </div>
</template>

<script>
import TableTools from "./TableTools";
import { mapGetters, mapMutations } from 'vuex';

export default {
    name: "Table",
    components: {TableTools},
    props: {
        'table': Object
    },
    computed: {
        ...mapGetters([
            'getTools',
            'getObjects'
        ]),
    },
    methods: {
        ...mapMutations([
            'setTools',
            'setColumns',
            'setFilters',
            'setPagination',
            'setCollection',
        ]),
    },
    created() {
        const _table = this.table
        this.setTools(_table.tools)
        this.setColumns(_table.columns)
        this.setFilters(_table.filters)
        this.setPagination(_table.pagination)
        this.setCollection(_table.collection)
    }
}
</script>
