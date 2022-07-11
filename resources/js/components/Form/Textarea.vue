<template>
    <tr>
        <Label :label="label" :required="required"/>
        <td>
            <input type="hidden" data-name="editorTarget" data-value="value">
            <div data-name="editor" :data-placeholder="placeholder"></div>
        </td>
    </tr>
</template>

<script>
import Label from "./Label";
export default {
    name: "Textarea",
    components: {Label}
}
</script>

<style scoped>

</style>
