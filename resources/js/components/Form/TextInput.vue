<template>
    <tr>
        <Label :label="field.label" :required="field.required"/>
        <td>
            <input class="form-control"
                   :disabled="field.disabled"
                   :required="field.required"
                   :placeholder="field.label"
                   type="text">
        </td>
    </tr>
</template>

<script>
import Label from "./Label";

export default {
    name: "TextInput",
    components: {Label},
    props: ['field']
}
</script>

<style scoped>

</style>
