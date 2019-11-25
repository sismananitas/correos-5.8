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
                            @submit.prevent="null"
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
                        </form>
                    </tab-content>

                    <tab-content
                        title="Elegir Plaza"
                        :before-change="registerEmployee"
                    >
                        <form
                            ref="formRegisterEmployee"
                            :action="editMode ? base_url + '/correo/trabajadores/' : base_url + '/correo/trabajadores'"
                        >
                            <input type="text" name="no_control" value="">
                            <div v-if="plazas.length">
                                <p>
                                    {{ plazas[0].nombre }} {{ plazas[0].paterno }} {{ plazas[0].materno }}
                                </p>

                                <select class="form-control" name="plaza">
                                    <option
                                        v-for="(plaza, index) in plazas"
                                        :key="index"
                                        :value="index"
                                    >
                                        {{ index }}
                                        {{ plaza.nomdep }}
                                        {{ plaza.tipo_puesto }}
                                    </option>
                                </select>
                            </div>
                        </form>
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

        handleValidation(isValid, tabIndex) {
            console.log('Tab: ' + tabIndex + ' valid: ' + isValid)
        },

        async validateActiveEmployee() {
            let form = this.$refs.formEmployee
            let dataJson = new FormData(form)

            await this.sendPostForm({ url: form.action, data: dataJson })
            .then(() => {
                if (this.response) {
                    swal.close()
                    this.plazas = this.response.plazas
                    console.log(this.response.plazas);
                    console.log(this.plazas);
                    
                    this.validate = true
                } else {
                    this.validate = false
                }
            })
            return this.validate
        },

        async registerEmployee() {
            alert('registrado')
        }
    },

    mounted() {
        this.getEmployees()
    }
}
</script>

<style lang="scss">
.wizard-navigation {
    padding: 5px;
}
//@import url('https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css');
</style>