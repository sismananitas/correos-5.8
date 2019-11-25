<template>
    <div class="modal fade" id="addEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <form-wizard
                    title="Correos"
                    subtitle=""
                    @on-validate="handleValidation"
                >
                    <tab-content
                        title="Validar empleado activo"
                        :before-change="validateActiveEmployee"
                    >
                        <form
                            ref="formEmployee"
                            autocomplete="off"
                            :action="editMode ? base_url + '/correo/trabajadores/' : base_url + '/correo/trabajadores'"
                            @submit="sendForm"
                        >
                            <input v-if="editMode" type="hidden" name="_method" value="put">
                            <div class="modal-body">
                                <div class="card-body">
                                    Número de control
                                    <input list="empleados" class="form-control" type="text" name="control_number" required>

                                    <datalist id="empleados">
                                        <option
                                            v-for="employee in employees"
                                            :key="employee.id"
                                            :value="employee.numconemp"
                                        >
                                            {{ employee.numconemp + ' - ' + employee.nombre }}
                                        </option>
                                    </datalist>
                                </div>                      
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">registrar</button>
                            </div>
                        </form>
                    </tab-content>

                    <tab-content title="Additional Info">
                        My second tab content
                    </tab-content>

                    <tab-content title="Last step">
                        Yuhuuu! This seems pretty damn simple
                    </tab-content>
                </form-wizard>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex'
import { FormWizard, TabContent } from 'vue-form-wizard'

export default {
    props: {
        postUrl: String
    },

    data() {
        return {
            form: null,
            editMode: false,
            plazas: [],
            validate: false
        }
    },

    components: {
        FormWizard,
        TabContent
    },

    computed: {
        ...mapState(['employees', 'response', 'base_url'])
    },

    methods: {
        ...mapMutations(['setResponse', 'setErrors']),
        ...mapActions(['getEmployees', 'sendPostForm']),


        async validateActiveEmployee() {
            let form = this.$refs.formEmployee
            let dataJson = new FormData(form)

            await this.sendPostForm({ url: form.action, data: dataJson })
            .then(() => {
                if (this.response) {
                    console.log(this.response)
                    this.plazas = this.response.plazas
                    this.validate = true
                } else {
                    this.validate = false
                }
            })
            return this.validate
        },

        handleValidation(isValid, tabIndex) {
            console.log('Tab: ' + tabIndex + ' valid: ' + isValid)
        },

        sendForm(e) {
            let dataJson = new FormData(e.target)

            this.sendPostForm({ url: e.target.action, data: dataJson })
            .then(res => {
                if (this.response) {
                    console.log(this.response)
                    this.$emit('sendedForm')
                }
            })
            e.preventDefault()
        }
    },

    mounted() {
        this.getEmployees()
    }
}
</script>

<style lang="scss">
//@import url('https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css');
</style>