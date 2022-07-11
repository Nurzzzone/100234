<template>
    <form action="" method="">
        <input type="hidden">
        <table class="table table-striped table-bordered datatable">
            <tbody>
                <TextInput v-for="(field, index) in form.fields" :key="index" v-if="field.type === 'text'" :field="field"
                />
                <Radio v-else-if="field.type === 'radio'" :field="field"/>
            </tbody>
        </table>
        <div class="d-flex justify-content-end align-items-center">

            <a class="btn btn-outline-dark mr-1" href="">Назад</a>
            <button class="btn btn-outline-dark" type="submit">Подтвердить</button>
        </div>
    </form>
</template>

<script>
import TextInput from "./TextInput";
import Textarea from "./Textarea";
import Radio from "./Radio";
export default {
    name: "Form",
    components: {Radio, Textarea, TextInput},
    props: {
        form: Object,
    },
    created() {
        console.log('here')
    },
}
</script>

<style scoped>

</style>
