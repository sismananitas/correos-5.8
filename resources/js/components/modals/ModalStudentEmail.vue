<template>
    <div class="modal fade" id="addAlumno">
        <div class="modal-dialog">
            <div class="modal-content">
                <form-wizard
                    ref="alumnoWizard"
                    title=""
                    subtitle=""
                    color="#0ba49f"
                    @on-complete="finishProcess"
                >
                    <tab-content
                        title="Validar matrícula"
                        :before-change="validateStudent"
                    >
                        <form
                            ref="formAlumno"
                            action="#"
                            autocomplete="off"
                            @submit.prevent=""
                        >
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="enrollment">Matrícula</label>
                                    <input list="alumnos" class="form-control" type="text" name="enrollment" value="" required>
                                    <datalist id="alumnos">
                                        <option v-for="student in students" :key="student.matricula" :value="student.matricula">
                                            {{ student.matricula + ' - ' + student.ap_paterno + ' ' + student.ap_materno + ' ' + student.nombre }}
                                        </option>
                                    </datalist>
                                    <p class="text-danger" v-if="errors.enrollment">{{ errors.enrollment[0] }}</p>
                                    <p class="text-danger" v-if="errors.correo">{{ errors.correo[0] }}</p>
                                </div>
                            </div>
                        </form>
                    </tab-content>
                    <tab-content
                        title="Registrar alumno"
                        :before-change="registerStudent"
                    >
                        <form
                            v-if="student"
                            ref="formRegisterStudent"
                            action="#"
                        >
                            <input type="hidden" name="emailable_id" :value="student.matricula">
                            <input type="hidden" name="emailable_type" value="student">
                            <input type="hidden" name="dependency" :value="student.unidad">
                            <p>
                                Nombre: {{ student.nombre }} {{ student.ap_paterno }} {{ student.ap_materno }} <br>
                                Dependencia: {{ student.unidad }}
                            </p>
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
import { mapState, mapActions } from 'vuex';
import { FormWizard, TabContent } from 'vue-form-wizard'
export default {
    props: {
        PostUrl: String
    },
    components: {
        FormWizard,
        TabContent
    },
    data() {
        return {
            validate: false,
            student: null
        }
    },
    computed: {
        ...mapState(['students', 'base_url', 'response', 'errors'])
    },
    methods: {
        ...mapActions(['getStudents', 'sendPostForm']),

        finishProcess() {
            $('#addAlumno').modal('hide')
            this.$emit('formSended')
        },
        
        async validateStudent() {
            let form = this.$refs.formAlumno
            let dataJson = new FormData(form)

            showLoading()
            await this.sendPostForm({ url: '/api/students/emails', data: dataJson })
            .then(() => {
                closeLoading()
                if (this.response) {
                    console.log(this.response)
                    this.student = this.response.student
                    this.validate = true
                } else {
                    this.validate = false
                }
            })
            return this.validate
        },

        async registerStudent() {
            let form = this.$refs.formRegisterStudent
            let dataJson = new FormData(form)

            showLoading()

            await this.sendPostForm({ url: '/api/emails', data: dataJson })
            .then(() => {
                closeLoading()
                if (this.response) {
                    console.log(this.response)
                    this.validate = true
                } else {
                    this.validate = false
                }
            })
            return this.validate
        }
    },

    mounted() {
        this.getStudents();
        $('#addAlumno').on('hidden.bs.modal', () => {
            this.$refs.formAlumno.reset()
            this.$refs.alumnoWizard.reset()
        })
    }
}
</script>