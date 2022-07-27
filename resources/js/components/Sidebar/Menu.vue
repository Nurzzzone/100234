<template>
    <div>
        <div v-for="(menuElement, index) in menuElements" :key="index">
            <v-sidebar-title v-if="menuElement.slug === 'title'"
                             :name="menuElement.name"></v-sidebar-title>
            <v-sidebar-dropdown v-else-if="menuElement.slug === 'dropdown'"
                                :children="menuElement.elements"
                                :name="menuElement.name"
                                :icon="menuElement.icon"></v-sidebar-dropdown>
            <v-sidebar-link v-else
                            :name="menuElement.name"
                            :icon="menuElement.icon"></v-sidebar-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Menu",
    props: ['menuElements'],
}
</script>

<style scoped>

</style>