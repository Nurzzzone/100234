<template>
    <th class="align-middle">
        <span v-text="label"></span>
        <span v-show="isRequired" class="text-danger">*</span>
    </th>
</template>

<script>
export default {
    name: "Label"
}
</script>

<style scoped>

</style>
