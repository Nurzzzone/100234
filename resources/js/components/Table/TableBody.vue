<template>
    <tbody>
        <tr v-for="object in getTableObjects" :key="object.id" data-name="tableRow">
            <v-table-data v-for="(column, index) in  getTableColumns"
                          :key="index"
                          :type="column.type"
                          :column="column"
                          :label="resolveLabel(object, column.columnName)"
                          :object="object"
            ></v-table-data>

            <v-table-data :type="'buttons'" :object="object"></v-table-data>
        </tr>
    </tbody>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "TableBody",
    computed: {
        ...mapGetters([
            'getTableColumns',
            'getTableObjects',
        ])
    },
    methods: {
        resolveLabel(object, columnName) {
            if (! columnName.includes('.')) {
                return object[columnName];
            }

            if ((columnName.match('\.+') || []).length === 1) {
                let relationName = columnName.split('.')[0];
                columnName = columnName.split('.')[1];

                return object[relationName][columnName];
            }

            return this.getNestedColumn();
        },

        getNestedColumn() {
            return 'надо дописать';
        },
    }
}
</script>

<style scoped>
table tr {
    cursor: default;
}
</style>
