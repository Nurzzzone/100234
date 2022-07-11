<template>
    <th class="align-middle">
        <span v-text="label"></span>
        <span v-show="required" class="text-danger">*</span>
    </th>
</template>

<script>
export default {
    name: "Label",
    props: ['label', 'required']
}
</script>

<style scoped>

</style>
