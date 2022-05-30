<template>
    <thead>
    <tr>
        <th v-for="(column, index) in this.$parent.tableConfig.columns" :key="index" class="border-bottom-0 align-middle">
            {{ column.label }}
        </th>
        <th v-if="this.$parent.tableConfig.buttonsEnabled" class="border-bottom-0 align-middle"></th>
    </tr>
    </thead>
</template>

<script>
export default {
    name: "TableHead"
}
</script>
