<template>
    <tr>
        <Label :label="label" :required="required"/>
        <td>
            <div class="custom-control custom-radio pl-0 mt-50">
                <input class="radio-active" type="radio" :id="activeInputId">
                <label class="label-active text-muted font-small-1 cursor-pointer" :for="activeInputId">Активировано</label>
            </div>
            <div class="custom-control custom-radio pl-0">
                <input class="radio-active" type="radio" :id="inactiveInputId">
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
    mixins: [uuid],
    data() {
        return {
            activeInputId: "",
            inactiveInputId: "",
        }
    },
    created() {
        this.activeInputId = this.uuid.v4()
        this.inactiveInputId = this.uuid.v4()
    },
}
</script>

<style scoped>

</style>
