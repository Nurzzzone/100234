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
                <table :id="tableId"
                       :class="{ 'table-hover': this.getObjects.length > 0 }"
                       :data-update-sequence-url="updateSequenceUrl"
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
        tableId: String,
        collection: Array,
        pagination: Object,
        columns: Array,
        tools: Object,
        filters: Array,
    },
    computed: {
        ...mapGetters([
            'getTools',
            'getObjects'
        ]),
    },
    methods: {
        ...mapMutations([
            'setPagination',
            'setCollection'
        ]),
    },
    created() {
        this.setPagination(this.pagination)
        this.setCollection(this.collection)
    }
}
</script>
