<template>
    <tbody>
        <tr v-for="object in getObjects" :key="object.id" data-name="tableRow">
            <v-table-data v-for="(column, index) in getColumns" :key="index"
                          :column="column"
                          :object="object"
            ></v-table-data>

            <v-table-data v-if="isButtonsEnabled" :type="'buttons'" :object="object"></v-table-data>
        </tr>
    </tbody>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "TableBody",
    computed: {
        ...mapGetters([
            'getColumns',
            'getObjects',
            'isButtonsEnabled'
        ])
    },
}
</script>

<style scoped>
table tr {
    cursor: default;
}
</style>
