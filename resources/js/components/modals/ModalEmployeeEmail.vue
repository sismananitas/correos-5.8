<template>
    <div class="modal fade" id="addEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <form-wizard
                    ref="empleadoWizard"
                    title=""
                    subtitle=""
                    color="#0ba49f"
                    @on-validate="handleValidation"
                    @on-complete="finishProcess"
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
                                <label for="control_number">Número de control</label>

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

                                <p class="text-danger" v-if="errors.control_number">{{ errors.control_number[0] }}</p>                    
                                <p class="text-danger" v-if="errors.correo">{{ errors.correo[0] }}</p>                    
                            </div>
                        </form>
                    </tab-content>

                    <tab-content
                        title="Elegir Plaza"
                        :before-change="registerEmployee"
                    >
                        <form
                            ref="formRegisterEmployee"
                            :action="base_url + '/correos'"
                        >
                            <input type="hidden" name="emailable_id" :value="num_control">
                            <input type="hidden" name="emailable_type" value="employee">

                            <p v-if="plazas.length">
                                Nombre: {{ plazas[0].nombre }} {{ plazas[0].paterno }} {{ plazas[0].materno }}
                            </p>

                            <div class="form-group" v-if="plazas.length">
                                <select class="form-control" name="dependency">
                                    <option
                                        v-for="(plaza, index) in plazas"
                                        :key="index"
                                        :value="plaza.nomdep"
                                    >
                                        {{ index + 1 }}. {{ plaza.nomdep }} | {{ plaza.tipo_puesto }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="client_name">Solicitante del cambio</label>
                                    <input id="client_name" class="form-control" type="text" name="client_name" required>

                                    <p class="text-danger" v-if="errors.client_name">{{ errors.client_name[0] }}</p>
                                </div>
                    
                                <div class="form-group col">
                                    <label for="delivered_to">Entregado a</label>
                                    <input class="form-control" type="text" name="delivered_to" required>

                                    <p class="text-danger" v-if="errors.delivered_to">{{ errors.delivered_to[0] }}</p>
                                </div>                 
                            </div>
                    
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input id="login" class="form-control" type="email" name="login" required>

                                <p class="text-danger" v-if="errors.login">{{ errors.login[0] }}</p>
                            </div>
                    
                            <div class="form-grou">
                                <label for="password">Contraseña</label>
                                <input id="password" class="form-control" type="text" name="password" required>

                                <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                            </div>
                    
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="medium">Medio de solicitud</label>
                                    <select class="form-control" name="medium" id="medium" required>
                                        <option value="">- Elegir -</option>
                                        <option value="Ticket">Ticket</option>
                                        <option value="Oficio">Oficio</option>
                                    </select>

                                    <p class="text-danger" v-if="errors.medium">{{ errors.medium[0] }}</p>
                                </div>
                    
                                <div class="col form-group">
                                    <label for="status">Estatus</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="">- Elegir -</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Suspendido">Suspendido</option>
                                        <option value="Eliminado">Eliminado</option>
                                    </select>

                                    <p class="text-danger" v-if="errors.status">{{ errors.status[0] }}</p>
                                </div>
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

    components: {
        FormWizard,
        TabContent
    },

    data() {
        return {
            form: null,
            editMode: false,
            plazas: [],
            num_control: null,
            validate: false
        }
    },

    computed: {
        ...mapState(['employees', 'response', 'errors', 'base_url'])
    },

    methods: {
        ...mapMutations(['setResponse', 'setErrors']),
        ...mapActions(['getEmployees', 'sendPostForm']),

        handleValidation(isValid, tabIndex) {
            console.log('Tab: ' + tabIndex + ' valid: ' + isValid)
        },

        finishProcess() {
            $('#addEmpleado').modal('hide')
            this.$emit('formSended')
        },

        async validateActiveEmployee() {
            let form = this.$refs.formEmployee
            let dataJson = new FormData(form)

            await this.sendPostForm({ url: form.action, data: dataJson })
            .then(() => {
                if (this.response) {
                    swal.close()
                    this.plazas      = this.response.plazas
                    this.num_control = this.response.num_control
                    this.validate    = true

                } else {
                    this.validate = false
                }
            })
            return this.validate
        },

        async registerEmployee() {
            let form = this.$refs.formRegisterEmployee
            let dataJson = new FormData(form)

            await this.sendPostForm({ url: form.action, data: dataJson })
            .then(() => {
                if (this.response) {
                    swal.close()
                    this.validate = true

                } else {
                    this.validate = false
                }
            })
            return this.validate
        }
    },

    mounted() {
        this.getEmployees()
        $('#addEmpleado').on('hidden.bs.modal', () => {
            this.$refs.formEmployee.reset()
            this.$refs.empleadoWizard.reset()
        })
    }
}
</script>

<style lang="scss">
.wizard-navigation {
    padding: 5px;
}
//@import url('https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css');
</style>