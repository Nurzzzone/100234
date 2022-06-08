<template>
    <div>
        <div class="card">
            <!-- TableComponent -->
            <div class="card-body">
                <table-tools class="mb-4"></table-tools>
                <table :id="tableId"
                       :class="{ 'table-hover': hover }"
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

export default {
    name: "Table",
    components: {TableTools},
    props: {
        tableId: String,
        updateSequenceUrl: String,
        paginationInstance: Object,
        hover: String,
        tableConfig: Object
    },
    created() {
        this.$store.commit('setPaginationInstance', this.paginationInstance);
        this.$store.commit('setTableConfig', this.tableConfig);
    }
}
</script>