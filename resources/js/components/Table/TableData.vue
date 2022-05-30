<template>
    <td v-if="!this.$slots.default" v-bind:class="{ 'text-muted': !label }">{{ label? label: 'Отсутствует' }}</td>
    <td v-else>
        <slot></slot>
    </td>
</template>

<script>
export default {
    name: "TableData",
    props: ['label']
}
</script>
