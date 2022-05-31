<template>
    <td v-if="!this.$slots.default" v-bind:class="{ 'text-muted': label !== null}">{{ label !== null? label: 'Отсутствует' }}</td>
    <td v-else>
        <slot></slot>
    </td>
</template>

<script>
export default {
    name: "TableData",
    props: ['label'],
}
</script>
