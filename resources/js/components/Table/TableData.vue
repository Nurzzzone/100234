<template>
    <td v-if="column.type === 'text'" v-bind:class="{ 'text-muted': !label}" v-text="getTextLabel"></td>

    <td v-else-if="column.type === 'check'"><i :class="getCheckLabel"></i></td>

    <td v-else-if="column.type === 'toggle'">
        <div class="custom-control custom-switch">
            <input @input="updateToggleState($event)"
                   type="checkbox"
                   class="custom-control-input"
                   :id="id"
                   :checked="Boolean(this.label)">
            <label class="custom-control-label" :for="id"></label>
        </div>
    </td>

    <td v-else-if="column.type === 'syncToggle'">
        <div class="custom-control custom-switch" >
            <input data-name="toggle"
                   @input="syncUpdateToggleState($event)"
                   type="checkbox"
                   class="custom-control-input"
                   :id="id"
                   :checked="Boolean(this.label)">
            <label class="custom-control-label" :for="id"></label>
        </div>
    </td>

    <td v-else-if="column.type === 'buttons' && this.isButtonsEnabled">
        <div class="btn-group d-flex">
            <a v-if="this.isEditEnabled" :href="this.getEditUrl" class="btn btn-outline-dark">Редактировать</a>
            <button v-if="this.isDeleteEnabled"
                    type="button"
                    data-toggle="modal"
                    :data-target="object.id"
                    data-name="deleteModalButton"
                    class="btn btn-outline-dark">Удалить
            </button>
        </div>
    </td>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "TableData",
    data() {
        return {
            id: "",
            label: null
        }
    },
    props: {
        object: Object,
        column: Object,
        type: String,
    },
    created() {
        this.id = this.uuid4()
        this.resolveLabel(this.object, this.column.columnName)
    },
    computed: {
        ...mapGetters([
            'getTools',
            'getEditUrl',
            'isEditEnabled',
            'isDeleteEnabled',
            'isButtonsEnabled',
        ]),
        getTextLabel() {
            return this.label? this.label: 'Отсутствует'
        },
        getCheckClass() {
            return Boolean(this.label)? 'text-success': 'text-danger'
        },
        getCheckLabel() {
            return Boolean(this.label)? 'cil-check': 'cil-x'
        }
    },
    methods: {
        ...mapActions([
            'updateToggle',
            'updatePaginationInstance'
        ]),

        uuid4() {
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        },

        updateToggleState(e) {
            e.target.setAttribute('disabled', true);

            if (! this.object.updateToggleUrl) {
                throw 'Please add "getUpdateToggleUrlAttribute" method and "updateToggleUrl" into "$appends" property on your model!'
            }

            this.updateToggle({
                url: this.object.updateToggleUrl,
                columnName: this.column.columnName,
                toggleValue: Number(e.target.checked)
            }).finally(() => e.target.removeAttribute('disabled'));
        },

        syncUpdateToggleState(e) {
            if (e.target.disabled) {
                return
            }

            const toggles = Array.from(document.querySelectorAll('input[data-name="toggle"]'));

            toggles.forEach((el) => {
                el.setAttribute('disabled', true);
            });

            this.updateToggle({
                url: this.object.updateToggleUrl,
                columnName: this.column.columnName,
                toggleValue: Number(e.target.checked)
            }).then(() => {
                this.updatePaginationInstance()
            }).finally(() => {
                toggles.forEach((el) => {
                    el.removeAttribute('disabled');
                });
            });
        },

        resolveLabel(object, columnName) {
            if (! columnName.includes('.')) {
                return this.label =  object[columnName];
            }

            if ((columnName.match('\.+') || []).length === 1) {
                let relationName = columnName.split('.')[0];
                columnName = columnName.split('.')[1];

                return this.label = object[relationName][columnName];
            }

            return this.getNestedColumn();
        },

        getNestedColumn() {
            return 'надо дописать';
        },
    }
}
</script>

<style scoped>
.custom-control-input:focus ~ .custom-control-label::before {
    border-color: red !important;
    box-shadow: none !important;
}

.custom-control-input:checked ~ .custom-control-label::before {
    border-color: #9da5b1 !important;
    background-color: #9da5b1 !important;
}

.custom-control-input:active ~ .custom-control-label::before {
    border-color: #9da5b1 !important;
    background-color: #9da5b1 !important;
}

.custom-control-input:focus:not(:checked) ~ .custom-control-label::before {
    border-color: #9da5b1 !important;
}

.custom-control-input-green:not(:disabled):active ~ .custom-control-label::before {
    border-color: #9da5b1 !important;
    background-color: #9da5b1 !important;
}

.custom-switch label {
    cursor: pointer;
}
</style>
