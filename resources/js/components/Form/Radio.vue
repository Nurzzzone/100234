<template>
    <tr>
        <Label :label="field.label" :required="field.required"/>
        <td>
            <div class="custom-control custom-radio pl-0 mt-50">
                <input class="radio-active" type="radio" :name="field.columnName" :id="activeInputId">
                <label class="label-active text-muted font-small-1 cursor-pointer" :for="activeInputId">Активировано</label>
            </div>
            <div class="custom-control custom-radio pl-0">
                <input class="radio-active" type="radio" :name="field.columnName" :id="inactiveInputId" checked>
                <label class="label-active text-muted font-small-1 cursor-pointer" :for="inactiveInputId">Не активно</label>
            </div>
        </td>
    </tr>
</template>

<script>
import Label from "./Label";
import uuid from "../../mixins/uuid";
export default {
    name: "Radio",
    components: {Label},
    props: ['field'],
    mixins: [uuid],
    data() {
        return {
            activeInputId: "",
            inactiveInputId: "",
        }
    },
    created() {
        this.activeInputId = uuid.v4()
        this.inactiveInputId = uuid.v4()
    },
}
</script>

<style scoped>

</style>
