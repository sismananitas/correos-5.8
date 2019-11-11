<template>
    <div class="modal fade" id="addEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Correo alumno</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form-wizard>
                    <tab-content title="Personal details">
                        <form id="formEmployee" :action="postUrl" method="POST" autocomplete="off">
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
import { mapState, mapActions } from 'vuex';
import Axios from 'axios';
import { FormWizard, TabContent } from 'vue-form-wizard'

export default {
    props: {
        postUrl: String
    },

    data() {
        return {
            form: '',
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
        ...mapActions(['getEmployees'])
    },

    mounted() {
        this.getEmployees();
        this.form = document.getElementById('formEmployee');

        this.form.addEventListener('submit', e => {
            e.preventDefault();
            this.data = new FormData(this.form);

            Axios.post(this.form.action, this.data)
            .then(res => {
                console.log(res);
            })
        })
    }
}
</script>