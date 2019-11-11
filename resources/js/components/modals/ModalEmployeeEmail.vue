<template>
    <div class="modal fade" id="addEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Correo alumno</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="formAlumno" action="#" method="POST" autocomplete="off">
                    <input id="editMode" type="hidden" name="_editMode" value="false">

                    <div class="modal-body">
                        <div class="card-body">
                            Número de control
                            <input list="empleados" class="form-control" type="text" name="control_number" value="" required>

                            <datalist id="empleados">
                                <option v-for="employee in employees" :key="employee.control_number" :value="employee.control_number"> {{ employee.control_number }} </option>
                            </datalist>
                        </div>                      
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
    computed: {
        ...mapState(['employees'])
    },

    methods: {
        ...mapActions(['getEmployees'])
    },

    mounted() {
        this.getEmployees();
    }
}
</script>