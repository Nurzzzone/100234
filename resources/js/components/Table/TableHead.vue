<template>
    <thead>
    <tr>
        <th v-for="(column, index) in this.getTableColumns" :key="index" class="border-bottom-0 align-middle">
            {{ column.label }}
        </th>
        <th v-if="this.getTableTools.buttonsEnabled" class="border-bottom-0 align-middle"></th>
    </tr>
    </thead>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "TableHead",
    computed: {
        ...mapGetters([
            'getTableTools',
            'getTableColumns',
        ])
    },
}
</script>
