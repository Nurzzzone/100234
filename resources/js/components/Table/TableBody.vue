<template>
    <tbody>
        <tr v-for="object in getTableObjects" :key="object.id" data-name="tableRow">
            <v-table-data v-for="(column, index) in  getTableColumns" :key="index" :label="resolveLabel(object, column.columnName)"></v-table-data>

            <!-- Buttons -->
            <v-table-data v-if="getTableTools.buttonsEnabled">
                <div class="btn-group d-flex">
                    <a v-if="getTableTools.editEnabled" :href="object.editUrl" class="btn btn-outline-dark">Редактировать</a>
                    <button v-if="getTableTools.deleteEnabled"
                            type="button"
                            data-toggle="modal"
                            :data-target="object.id"
                            data-name="deleteModalButton"
                            class="btn btn-outline-dark">Удалить
                    </button>
                </div>
            </v-table-data>
        </tr>
    </tbody>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "TableBody",
    computed: {
        ...mapGetters([
            'getTableTools',
            'getTableColumns',
            'getTableObjects',
            'getTableFilters',
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
        }
    }
}
</script>
