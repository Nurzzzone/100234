<template>
    <tr>
        <Label :label="label" :required="required"/>
        <td>
            <input class="form-control"
                   :disabled="isDisabled"
                   :required="isRequired"
                   :placeholder="placeholder"
                   type="text">
        </td>
    </tr>
</template>

<script>
import Label from "./Label";

export default {
    name: "TextInput",
    components: {Label}
}
</script>

<style scoped>

</style>
