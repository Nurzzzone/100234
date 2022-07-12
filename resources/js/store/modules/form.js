export default {
    state: {
        form: {
            fields: [],
            currentObject: {},
            formPayload: {},
        },
    },
    getters: {
        getForm: state => state.form,
        getFormAction: state => state.form.action,
        getFormPayload: state => state.form.formPayload,
    },
    mutations: {
        setForm: (state, value) => state.form = value,
    },
    actions: {
        updateOrCreateFormObject({commit, getters}) {
            return axios.post(getters.getFormAction, getters.getFormPayload)
        },
    }
}