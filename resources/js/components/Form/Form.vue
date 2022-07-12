<template>
    <form :action="form.action" method="POST">
        <table class="table table-striped table-bordered datatable">
            <tbody>
                <TextInput v-for="(field, index) in form.fields" :key="index" v-if="field.type === 'text'" :field="field"/>
                <Radio v-else-if="field.type === 'radio'" :field="field"/>
            </tbody>
        </table>
        <div class="d-flex justify-content-end align-items-center">

            <button class="btn btn-outline-dark mr-1" @click.prevent="console.log('should redirect back')">Назад</button>
            <button class="btn btn-outline-dark" type="submit" @click.prevent="updateOrCreateFormObject">Подтвердить</button>
        </div>
    </form>
</template>

<script>
import TextInput from "./TextInput";
import Textarea from "./Textarea";
import Radio from "./Radio";
import { mapMutations, mapActions } from 'vuex';

export default {
    name: "Form",
    components: {Radio, Textarea, TextInput},
    props: {
        form: Object,
    },
    created() {
        this.setForm(this.form)
    },
    methods: {
        ...mapMutations([
            'setForm',
        ]),
        ...mapActions([
            'updateOrCreateFormObject'
        ]),
    }
}
</script>