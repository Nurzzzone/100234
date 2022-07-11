<template>
    <tr>
        <Label :label="label" :required="required"/>
        <td>
            <select class="form-control" :placeholder="placeholder" :required="required">
                <option v-for="(caption, value) in options" :key="value" :value="value" v-text="caption"></option>
            </select>
            {{ Form::select($field, $select_options, $default, $options) }}
        </td>
    </tr>
</template>

<script>
import Label from "./Label";

export default {
    name: "Select",
    components: {Label}
}
</script>

<style scoped>

</style>
