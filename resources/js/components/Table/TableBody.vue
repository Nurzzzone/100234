<template>
    <tbody>
        <tr v-for="object in objects" :key="object.id" data-name="tableRow">
            <v-table-data v-for="(column, index) in  tableConfig.columns" :key="index" :label="object[column.columnName]"></v-table-data>

            <!-- Buttons -->
            <v-table-data v-if="tableConfig.tools.buttonsEnabled">
                <div class="btn-group d-flex">
                    <a v-if="tableConfig.tools.editEnabled" :href="object.editUrl" class="btn btn-outline-dark">Редактировать</a>
                    <button v-if="tableConfig.tools.deleteEnabled"
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
export default {
    name: "TableBody",
    props: {
        objects: Array
    },
    data() {
        return {
            tableConfig: this.$parent.tableConfig,
        }
    }
}
</script>
