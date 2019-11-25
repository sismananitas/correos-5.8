<template>
    <div class="modal fade" id="addEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->

                <form-wizard title="Correo alumno" subtitle="">
                    <tab-content title="Validar empleado activo">
                        <form
                            ref="formEmployee"
                            :action="postUrl"
                            method="POST"
                            v-on:submit="sendForm"
                            autocomplete="off"
                        >
                            <input id="editMode" type="hidden" name="_editMode" value="false">

                            <div class="modal-body">
                                <div class="card-body">
                                    Número de control
                                    <input list="empleados" class="form-control" type="text" name="control_number" value="" required>

                                    <datalist id="empleados">
                                        <option v-for="employee in employees" :key="employee.id" :value="employee.numconemp">
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
            data: {}
        }
    },

    components: {
        FormWizard,
        TabContent
    },

    computed: {
        ...mapState(['employees'])
    },

    methods: {
        ...mapMutations(['setResponse', 'setErrors']),
        ...mapActions(['getEmployees', 'sendPostForm']),

        // sendForm(e) {
        //     this.form = e.target;
        //     this.data = new FormData(e.target)

        //     axios.post(this.form.action, this.data)
        //     .then(res => {
        //         console.log(res)
        //         this.setResponse(res)
        //         this.$emit('sendedForm')
        //     })
        //     .catch(err => {
        //         let errors = err.response.data.errors;
        //         this.setErrors(errors)
        //     })

        //     e.preventDefault()
        // }
        sendForm(e) {
            let dataJson = new FormData(e.target)

            this.sendPostForm({ url: e.target.action, data: dataJson })
            .then(res => {
                if (this.response) {
                    console.log(this.response)
                    Swal.fire({
                        toast: true,
                        type: 'success',
                        position: 'top-right',
                        title: this.response.success,
                        timer: 200,
                        showConfirmButton: false
                    })
                    .then(() => {
                        this.$emit('sendedForm')
                    })
                }
            })
            e.preventDefault()
        }
    },

    mounted() {
        this.getEmployees();
    }
}
</script>